<!-- To use withing the Calendar class -->
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