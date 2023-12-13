<?php
require_once 'model/event.php';
require_once 'model/client.php';
require_once 'model/reason.php';
require_once 'view/view.php';

class Calendar  {
    private $WEEKDAYS = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    private $MONTHS = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
                           'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    
    private $year;
    private $month;
    private $day;
    private $displayedEvents;
    private $occupiedCells = [];

    public function __construct($advisorId) {
        if (!isset($_SESSION['calendarDay'])) {
            $this->year = date('Y');
            $this->month = date('m');
            $this->day = date('d');
        } else {
            $this->year = substr($_SESSION['calendarDay'], 6, 4);
            $this->month = substr($_SESSION['calendarDay'], 3, 2);
            $this->day = substr($_SESSION['calendarDay'], 0, 2);
        }

        $events = getEventsByAdvisor($advisorId);
        $this->setDisplayedEvents($events);
        $this->displayCalendar();       
    }

    public function displayCalendar() {
        require_once 'view/components/calendar-view.php';
    }

    private function getMonthName($month) {
        return $this->MONTHS[$month - 1];
    }

    /**
     * Returns the number of days in the given month and year
     * @param $month int
     * @param $year int
     * @return int
     */
    private function getDaysInMonth($month, $year) {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    /**
     * Returns the weekday index for the first day of the month
     * Ex: 1 for Monday, 2 for Tuesday, etc.
     * @param $month int
     * @param $year int
     * @return int
     */
    private function getFirstDayOfMonth($month, $year) {
        return date('N', strtotime($year . '-' . $month . '-01'));
    }

    /**
     * Returns the weekday name for the given day, month and year
     * @param $day int
     * @param $month int
     * @param $year int
     * @return string
     */
    private function getWeekdayName($day, $month, $year) {
        return $this->WEEKDAYS[date('N', strtotime($year . '-' . $month . '-' . $day)) - 1];
    }	

    /**
     * Returns an array of weeks for the given month and year
     * The weeks are arrays of days, which are arrays of [weekday, day]
     * Ex: [ [ [Lundi, 1], [Mardi, 2], [Mercredi, 3], [Jeudi, 4], [Vendredi, 5], [Samedi, 6], [Dimanche, 7] ] ]
     * So we have array of weeks, which are arrays of days, which are arrays of [weekday, day]
     * @param $month int
     * @param $year int
     * @return array
     */
    private function buildMonthWeeks($month, $year) {
        $weeks = []; // array of weeks
        $week = [];
        $daysInMonth = $this->getDaysInMonth($month, $year);
        $firstDayIndex = $this->getFirstDayOfMonth($month, $year);
        
        // if first day of month is not a monday, add days from previous month
        if ($firstDayIndex != 1) {
            $previousMonth = $month == 1 ? 12 : $month - 1;
            $previousYear = $month == 1 ? $year - 1 : $year;
            $daysInPreviousMonth = cal_days_in_month(CAL_GREGORIAN, $previousMonth, $previousYear);
    
            for ($day = $daysInPreviousMonth - $firstDayIndex + 2; $day <= $daysInPreviousMonth; $day++) {
                $weekday = $this->getWeekdayName($day, $previousMonth, $previousYear);
                $date = $previousYear . '-' . $previousMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT); 
                $week[] = [$weekday, $date];
            }
        }
    
        // add days from current month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $year . '-' . $month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
            $weekdayIndex = date('N', strtotime($date));
            $weekday = $this->getWeekdayName($day, $month, $year);
            $date = $year . '-' . $month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
    
            $week[] = [$weekday, $date];
    
            if ($weekdayIndex == 7) {
                $weeks[] = $week;
                $week = [];
            }
        }
    
        // add days from next month
        if (count($week) < 7) {
            $nextDay = 1;
            $nextMonth = $month == 12 ? 1 : $month + 1;
            $nextYear = $month == 12 ? $year + 1 : $year;
    
            while (count($week) < 7) {
                $weekday = $this->getWeekdayName($nextDay, $nextMonth, $nextYear);
                $date = $nextYear . '-' . $nextMonth . '-' . str_pad($nextDay, 2, '0', STR_PAD_LEFT);
                $week[] = [$weekday, $date];
                $nextDay++;
            }
        
        }
    
        if (!empty($week)) {
            $weeks[] = $week;
        }
    
        return $weeks;
    }

    /**
     * Returns the week index of the day in the month
     * @param $day int
     * @param $month int
     * @param $year int
     * @return int
     */
    private function getMonthWeekFromDay($day, $month, $year) {
        if ($day > $this->getDaysInMonth($month, $year)) {
            throw new Exception('Day is out of range for this month');
        }

        $date = $year . '-' . $month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

        $weeks = $this->buildMonthWeeks($month, $year);
        $weekIndex = 0;
        foreach ($weeks as $week) {
            foreach ($week as $dayOfWeek) {
                if ($dayOfWeek[1] == $date) {
                    return $weekIndex;
                }
            }
            $weekIndex++;
        }

        return -1;
    }

    /**
     * Returns the array of days to display in the calendar (as an array of [weekday, date])
     * @return array
     */
    private function getDaysToDisplay() {
        return $this->buildMonthWeeks($this->month, $this->year)[$this->getMonthWeekFromDay($this->day, $this->month, $this->year)];
    }

    /**
     * Returns the date of the given day of the week
     * @param $dayOfWeek int
     * @return string
     */
    private function getDateFromDayOfWeek($dayOfWeek) {
        $week = $this->getMonthWeekFromDay($this->day, $this->month, $this->year);
        $weeks = $this->buildMonthWeeks($this->month, $this->year);
        return $weeks[$week][$dayOfWeek][1];
    }

    /**
     * Sets the displayedEvents property to an array of events indexed by date
     * @param $events array
     * @return void
     */
    private function setDisplayedEvents($events) {
        $this->displayedEvents = [];
        foreach ($events as $event) {
            $eventDate = date('Y-m-d', strtotime($event->DATERDV));
            foreach ($this->getDaysToDisplay() as $day) {
                if ($day[1] == $eventDate) {
                    if (!isset($this->displayedEvents[$eventDate])) {
                        $this->displayedEvents[$eventDate] = [];
                    }
                    $this->displayedEvents[$eventDate][] = $event;
                }
            }
        }
    }


    private function displayCalendarEvent($date, $hour, $minute) {
        if (isset($this->displayedEvents[$date])) {
            $occupiedCells = [];
            foreach ($this->displayedEvents[$date] as $event) {
                if (getEventHour($event) == $hour && getEventMinute($event) == $minute) {
                    // calculate duration with DATERDV and DATEFINRDV
                    $eventStart = strtotime($event->DATERDV);
                    $eventEnd = strtotime($event->DATEFINRDV);
                    $eventDuration = ($eventEnd - $eventStart) / 60;
                    $eventColspan = $eventDuration / 30;

                    $this->occupiedCells[] = [$date, $hour, $minute];

                    // add this hour and minute to the occupied cells
                    // minutes are stored as 0, 30 and then increment hour
                    for ($i = 1; $i < $eventColspan; $i++) {
                        $minute = $minute == 0 ? 30 : 0;
                        $hour = $minute == 30 ? $hour : $hour + 1;
                        $this->occupiedCells[] = [$date, $hour, $minute];
                    }
                    require 'view/components/calendar-event.php';
                } else if (!in_array([$date, $hour, $minute], $this->occupiedCells)) {
                    echo "<td></td>";
                }
            }
        } else if (!in_array([$date, $hour, $minute], $this->occupiedCells)) {
            echo "<td></td>";
            $this->occupiedCells[] = [$date, $hour, $minute];
        }
    }


}   