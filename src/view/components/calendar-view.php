<!-- To use withing the Calendar class -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table class="calendar">
        <thead>
            <tr>
                <th></th>
                <?php foreach ($this->getDaysToDisplay() as $day): ?>
                    <th><?= $day[0] ?> <br> <?= $day[1] ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <!-- display one row per 30mn from 8:00 to 18:00 -->
            <?php for ($hour = 8; $hour < 18; $hour++): ?>
                <tr>
                    <td><?= $hour ?>:00</td>
                    <?php for ($dayOfWeek = 0 ; $dayOfWeek < 7; $dayOfWeek++): ?>
                        <?= $this->displayCalendarEvent($this->getDateFromDayOfWeek($dayOfWeek), $hour, 00) ?>
                    <?php endfor; ?>
                </tr>
                <tr>
                    <td><?= $hour ?>:30</td>
                    <?php for ($dayOfWeek = 0 ; $dayOfWeek < 7; $dayOfWeek++): ?>
                        <?= $this->displayCalendarEvent($this->getDateFromDayOfWeek($dayOfWeek), $hour, 30) ?>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</form>

<modal id="calendar-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Nouveau RDV</h1>
        <div class="spacer"></div>
        <div class="form-container">
            
            <div>
                <div class="label-containers">
                    <p>Date</p>
                    <p>Motif</p>
                    <p>Durée</p>
                </div>
                <div class="inputs">
                    <select readonly name="new-event-start-time" id="new-event-start-time">
                        <option value="" selected>Date</option>
                    </select>
                    <select name="new-event-reason" id="new-event-reason">
                        <?php foreach (getAllReasons() as $reason): ?>
                        <option value="<?= $reason->IDMOTIF ?>"><?= $reason->LIBELLEMOTIF ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="horizontal">
                        <input type="time" name="new-event-duration" id="new-event-duration" value="01:00" min="01:00" step="1800" readonly required>
                        <div class="arrow-container">
                            <button type="button" onclick="incrementDurationNewEvent()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </button>
                            <button type="button" onclick="decrementDurationNewEvent()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <button type="submit" name="add-event" id="add-event">Valider</button>
    </form>
</modal>

<modal id="reserve-time-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Se réserver un créneau</h1>
        <div class="spacer"></div>
        <div class="form-container">
            <div>
                <div class="label-containers">
                    <p>Date</p>
                    <p>Durée</p>
                </div>
                <div class="inputs">
                    <select readonly name="reserve-time-start-time" id="reserve-time-date">
                        <option value="" selected>Date</option>
                    </select>
                    <div class="horizontal">
                        <input type="time" name="reserve-time-duration" id="reserve-time-duration" value="00:30" min="00:30" step="1800" readonly required>
                        <div class="arrow-container">
                            <button type="button" onclick="incrementDurationReserveTime()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </button>
                            <button type="button" onclick="decrementDurationReserveTime()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <button type="submit" name="reserve-time" id="reserve-time">Valider</button>
    </form>

</modal>

<modal id="delete-event-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>Voulez-vous vraiment supprimer cet évènement ?</h2>
        <div>
            <button name="delete-event" id="delete-event" type="submit">Oui</button>
            <button onclick="closeDeleteEventModal()" type="button">Non</button>
        </div>
    </form>

</modal>

<script>
    let modal = document.getElementById('calendar-modal');
    let formattedDateHour = "";
    let maxEventDuration = "";

    function openNewEventModal(fDate, maxDuration) {
        modal.style.opacity = 1;
        modal.style.pointerEvents = "auto";
        formattedDateHour = fDate;
        maxEventDuration = maxDuration;

        document.querySelector("#calendar-modal input[type='time']").value = "01:00";

        document.querySelector("#new-event-start-time option").innerHTML = formattedDateHour.toString().replace('T', ' à ');
        document.querySelector("#new-event-start-time option").value = formattedDateHour;
    }

    function closeNewEventModal() {
        modal.style.opacity = 0;
        modal.style.pointerEvents = "none";
    }

    function incrementDurationNewEvent() {
        let duration = document.querySelector("#calendar-modal input[type='time']").value;
        if (duration > maxEventDuration) {
            duration = maxEventDuration;
            document.querySelector("#calendar-modal input[type='time']").value = duration;
            return;
        }
        let durationArray = duration.split(':');
        let hours = parseInt(durationArray[0]);
        let minutes = parseInt(durationArray[1]);
        let maxMinutes = parseInt(maxEventDuration.split(':')[1]);
        let maxHours = parseInt(maxEventDuration.split(':')[0]);
        if (hours == maxHours && minutes == maxMinutes) return;

        if (minutes == 30) {
            minutes = 0;
            hours++;
        } else {
            minutes = 30;
        }

        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes == 0) {
            minutes = "00";
        }
        document.querySelector("#calendar-modal input[type='time']").value = hours + ":" + minutes;
    }

    function decrementDurationNewEvent() {
        let duration = document.querySelector("#calendar-modal input[type='time']").value;
        let durationArray = duration.split(':');
        let hours = parseInt(durationArray[0]);
        let minutes = parseInt(durationArray[1]);
        if (hours == 1 && minutes == 0) return;

        if (minutes == 30) {
            minutes = 0;
        } else {
            minutes = 30;
            hours--;
        }

        if (hours < 10) hours = "0" + hours;
        if (minutes == 0) minutes = "00";

        document.querySelector("#calendar-modal input[type='time']").value = hours + ":" + minutes;
    }

    // click anywhere outside the modal to close it
    window.onclick = function(event) {
        if (event.target == modal) {
            closeNewEventModal();
        } else if (event.target == deleteEventModal) {
            closeDeleteEventModal();
        } else if (event.target == reserveTimeModal) {
            closeReserveTimeModal();
        }
    }

    let deleteEventModal = document.getElementById('delete-event-modal');

    function openDeleteEventModal($eventId) {
        deleteEventModal.style.opacity = 1;
        deleteEventModal.style.pointerEvents = "auto";
        deleteEventModal.querySelector("#delete-event").value = $eventId;
    }

    function closeDeleteEventModal() {
        deleteEventModal.style.opacity = 0;
        deleteEventModal.style.pointerEvents = "none";
    }

    let reserveTimeModal = document.getElementById('reserve-time-modal');

    function openReserveTimeModal($date, $timeUntilNextEvent) {
        reserveTimeModal.style.opacity = 1;
        reserveTimeModal.style.pointerEvents = "auto";

        formattedDateHour = $date;
        maxEventDuration = $timeUntilNextEvent;

        reserveTimeModal.querySelector("#reserve-time-modal input[type='time']").value = "00:30";

        reserveTimeModal.querySelector("#reserve-time-date option").value = $date;
        reserveTimeModal.querySelector("#reserve-time-date option").innerHTML = $date.toString().replace('T', ' à ');
    }

    function closeReserveTimeModal() {
        reserveTimeModal.style.opacity = 0;
        reserveTimeModal.style.pointerEvents = "none";
    }

    function incrementDurationReserveTime() {
        let duration = document.querySelector("#reserve-time-modal input[type='time']").value;
        if (duration > maxEventDuration) {
            duration = maxEventDuration;
            document.querySelector("#reserve-time-modal input[type='time']").value = duration;
            return;
        }
        let durationArray = duration.split(':');
        let hours = parseInt(durationArray[0]);
        let minutes = parseInt(durationArray[1]);
        let maxMinutes = parseInt(maxEventDuration.split(':')[1]);
        let maxHours = parseInt(maxEventDuration.split(':')[0]);
        if (hours == maxHours && minutes == maxMinutes) return;

        if (minutes == 30) {
            minutes = 0;
            hours++;
        } else {
            minutes = 30;
        }

        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes == 0) {
            minutes = "00";
        }
        document.querySelector("#reserve-time-modal input[type='time']").value = hours + ":" + minutes;
    }

    function decrementDurationReserveTime() {
        let duration = document.querySelector("#reserve-time-modal input[type='time']").value;
        let durationArray = duration.split(':');
        let hours = parseInt(durationArray[0]);
        let minutes = parseInt(durationArray[1]);
        if (hours == 0 && minutes == 30) return;

        if (minutes == 30) {
            minutes = 0;
        } else {
            minutes = 30;
            hours--;
        }

        if (hours < 10) hours = "0" + hours;
        if (minutes == 0) minutes = "00";

        document.querySelector("#reserve-time-modal input[type='time']").value = hours + ":" + minutes;
    }

</script>