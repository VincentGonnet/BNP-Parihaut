<td class="calendar-add-event">
    <button type="button" onclick='openModal("<?= $formattedDateHour ?>", "<?= $this->getTimeUntilNextEvent($date, $hour, $minute) ?>")'>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
    </button>
</td>