<?php
require_once 'model/event.php';
require_once 'model/client.php';
require_once 'model/reason.php';
require_once 'view/view.php';

class Calendar {
    private $WEEKDAYS = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    private $MONTHS = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
                           'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    
    private $year;
    private $month;
    private $day;
    private $displayedEvents;
    private $occupiedCells = [];
    private $eventCells = [];
    private $seededDates = [];

    public function __construct($advisorId) {
        if (!isset($_SESSION['calendarDay'])) {
            $_SESSION['calendarDay'] = date('Y-m-d');
            $this->year = date('Y');
            $this->month = date('m');
            $this->day = date('d');
        } else {
            // $_SESSION['calendarDay'] is in format YYYY-MM-DD
            $this->year = date('Y', strtotime($_SESSION['calendarDay']));
            $this->month = date('m', strtotime($_SESSION['calendarDay']));
            $this->day = date('d', strtotime($_SESSION['calendarDay']));
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


    /**
     * Displays the event cell for the given date, hour and minute
     * @param $date string
     * @param $hour int
     * @param $minute int
     * @return void
     */
    private function displayCalendarEvent($date, $hour, $minute) {
        if (isset($this->displayedEvents[$date])) {
            // seed the events cells of this date if not already done
            if (!in_array($date, $this->seededDates)) {
                $this->seedEventCells($date);
            }

            // check if displaying an event cell, else display an empty cell if not occupied
            if (in_array([$date, $hour, $minute], $this->eventCells) && !in_array([$date, $hour, $minute], $this->occupiedCells)) {
                // search among all events of the day for the event that starts at this hour and minute
                $event = null;
                foreach ($this->displayedEvents[$date] as $e) {
                    if (getEventHour($e) == $hour && getEventMinute($e) == $minute) {
                        $event = $e;
                        break;
                    }
                }
                if ($event == null) {
                    throw new Exception('Event not found');
                }

                $eventStart = strtotime($event->DATERDV);
                $eventEnd = strtotime($event->DATEFINRDV);
                $eventDuration = ($eventEnd - $eventStart) / 60;
                $eventRowspan = $eventDuration / 30; // Used in calendar-event.php

                for ($i = 1; $i < $eventRowspan; $i++) {
                    $minute = $minute == 0 ? 30 : 0;
                    $hour = $minute == 30 ? $hour : $hour + 1;
                    $this->occupiedCells[] = [$date, $hour, $minute];
                }

                if (empty($event->NUMCLIENT)) {
                    require 'view/components/calendar-reserved-slot.php';
                } else {
                    require 'view/components/calendar-event.php';
                }
            } else if (!in_array([$date, $hour, $minute], $this->occupiedCells)) {
                $this->displayEmptyCell($date, $hour, $minute);
                $this->occupiedCells[] = [$date, $hour, $minute];
            }
        } else if (!in_array([$date, $hour, $minute], $this->occupiedCells)) {
            $this->displayEmptyCell($date, $hour, $minute);
            $this->occupiedCells[] = [$date, $hour, $minute];
        }
    }

    /**
     * Adds the events of the given date to the event cells
     * It will create an array of that will be seeded before displaying the cells
     * It allows to check if the next half hour is occupied, allowing to change the display accordingly
     * @param $date string
     * @return void
     */
    private function seedEventCells($date) {
        // for each hour between 8:00 and 18:00, check if there is an event
        for ($hour = 8; $hour < 18; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 30) {
                foreach ($this->displayedEvents[$date] as $event) {
                    if (getEventHour($event) == $hour && getEventMinute($event) == $minute) {
                        $this->eventCells[] = [$date, $hour, $minute]; // add the event to the event cells
                    }
                }
            }
        }
        $this->seededDates[] = $date;
    }

    /**
     * Displays an empty cell
     * If the current page is advisor-planning, it will display an empty cell
     * If the current page is agent-client-appointments, it will display a button to add an event
     * If the next half hour is occupied, it will not display the button
     * @param $date string
     * @param $hour int
     * @param $minute int
     * @return void
     */
    private function displayEmptyCell($date, $hour, $minute) {
        $isAdvisorPlanning = $_SESSION['currentPage'] == 'advisor-planning';
        if ($isAdvisorPlanning) {
            $formattedDateHour = date('Y-m-d H:i', strtotime($date . ' ' . $hour . ':' . $minute));
            require 'view/components/calendar-add-event.php';
        } else if (!$this->isNextHalfHourOccupied($date, $hour, $minute)) {
            $formattedDateHour = date('Y-m-d H:i', strtotime($date . ' ' . $hour . ':' . $minute));
            require 'view/components/calendar-add-event.php';
        } else {
            echo "<td></td>";
        }
    }

    /**
     * Returns true if the next half hour is occupied
     * @param $date string
     * @param $hour int
     * @param $minute int
     * @return bool
     */
    private function isNextHalfHourOccupied($date, $hour, $minute) {
        $nextHour = $minute == 30 ? $hour + 1 : $hour;
        $nextMinute = $minute == 30 ? 0 : 30;
        if ($nextHour == 18 && $nextMinute == 00) {
            return true;
        }
        if ($nextHour == 18 && $nextMinute == 00) {
            return true;
        }
        return in_array([$date, $nextHour, $nextMinute], $this->eventCells);
    }

    private function getTimeUntilNextEvent($date, $hour, $minute) {
        $initialTimeStamp = strtotime($date . ' ' . $hour . ':' . $minute);
        $timeToNextEvent = date('h:i' ,strtotime($date . ' ' . 17 . ':' . 00) - $initialTimeStamp);
        
        if (empty($this->displayedEvents[$date])) {
            return $timeToNextEvent;
        }

        if ($hour == 17 && $minute == 30) {
            return "00:30";
        }

        while ($hour < 18) {
            if (in_array([$date, $hour, $minute], $this->eventCells)) {
                return date('H:i' ,strtotime($date . ' ' . $hour-1 . ':' . $minute) - $initialTimeStamp);
            }
            
            if ($minute == 30) {
                $minute = 0;
                $hour++;
            } else {
                $minute = 30;
            }
        }

        return $timeToNextEvent;
    }


}   