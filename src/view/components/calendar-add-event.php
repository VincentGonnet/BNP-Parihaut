<td class="calendar-add-event">
    <?php if($isAdvisorPlanning): ?>
        <!-- same button but blue -->
        <?php if($_SESSION['loggedInUser']->NUMEMPLOYE == $_SESSION['advisorToViewPlanning']->NUMEMPLOYE): ?>
            <button type="button" class="reserved-time-slot" onclick='openReserveTimeModal("<?= $formattedDateHour ?>", "<?= $this->getTimeUntilNextEvent($date, $hour, $minute) ?>")'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
            </button>
        <?php endif; ?>
    <?php else: ?>
        <button type="button" onclick='openNewEventModal("<?= $formattedDateHour ?>", "<?= $this->getTimeUntilNextEvent($date, $hour, $minute) ?>")'>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </button>
    <?php endif; ?>
</td>