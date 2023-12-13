<?php
require_once 'model/calendar.php';

$_SESSION['calendarDay'] = "13-12-2023";
$calendar = new Calendar($_SESSION['loggedInUser']->NUMEMPLOYE);