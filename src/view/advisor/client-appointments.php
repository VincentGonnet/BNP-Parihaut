<div id="advisor-planning">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Conseiller du client :</p>
        <select disabled>
            <?php
            $advisor = getEmployeeById($_SESSION['currentClient']->NUMEMPLOYE);
            ?>
            <option value=" <?= $_SESSION['currentClient']->NUMEMPLOYE ?>" selected> <?= $advisor->PRENOM." ".strtoupper($advisor->NOM) ?></option>
        </select>
        <div style="flex: 100;"></div>
        <input type="date" name="planning-select-date" id="planning-select-date" onblur="this.form.submit()"
        value="<?= isset($_SESSION['calendarDay']) ? date('Y-m-d', strtotime($_SESSION['calendarDay'])) : date('Y-m-d') ?>"
        >
        <div style="flex: 1;"></div>
        <button class="planning-nav" name="planning-prev-week" id="planning-prev-week">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>
        <button class="planning-nav" name="planning-next-week" id="planning-next-week">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </form>
    <?php
    require_once 'model/calendar.php';
    
    $calendar = new Calendar($_SESSION['currentClient']->NUMEMPLOYE);
    ?>
</div>