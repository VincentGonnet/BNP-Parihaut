<div id="advisor-planning">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Voir le planning de :</p>
        <select name="selectAdvisorToViewPlanning" id="selectAdvisorToViewPlanning" onchange="this.form.submit()">
            <?php foreach (getAllAdvisors() as $advisor): ?>
                <!-- The long condition sets the default selected employee -->
                <option value="<?= $advisor->NUMEMPLOYE ?>" 
                    <?= (isset($_SESSION['advisorToViewPlanning']) && $_SESSION['advisorToViewPlanning']->NUMEMPLOYE == $advisor->NUMEMPLOYE) || (!isset($_SESSION['advisorToViewPlanning']) &&  $_SESSION['loggedInUser']->NUMEMPLOYE == $advisor->NUMEMPLOYE)
                        ? "selected" : "" ?> 
                >
                    <?= $advisor->PRENOM." ".strtoupper($advisor->NOM) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div style="flex: 100;"></div>
        <input type="date" name="planning-select-date" id="planning-select-date" onchange="this.form.submit()"
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
    
    $calendar = new Calendar(
        isset($_SESSION['advisorToViewPlanning']) ?
        $_SESSION['advisorToViewPlanning']->NUMEMPLOYE : 
        $_SESSION['loggedInUser']->NUMEMPLOYE
    );
    ?>
</div>