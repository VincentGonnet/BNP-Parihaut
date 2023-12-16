<?php

require_once 'controller/controller.php';

if (!empty($_POST)) {
    $postKey = array_keys($_POST)[0];
    if (explode('-', $postKey)[0] == "redirect") {  // if first part of the key is "redirect", then redirect to the route specified in the key
        $route = array_slice(explode('-', $postKey), 1);
        CtlChangeView(implode('-', $route));
    }
}

if (isset($_POST['connection'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    CtlLogin($login, $password);
} else if (isset($_POST['logout'])) {
    CtlLogout();
} else if (isset($_POST['agent-search-client-by-id'])) {
    $clientId = $_POST['client-id'];
    CtlSearchClientById($clientId);
} else if (isset($_POST['agent-search-client-by-name'])) {
    $clientName = $_POST['client-name'];
    $clientFirstName = $_POST['client-firstname'];
    CtlSearchClientByName($clientName, $clientFirstName);
} else if (isset($_POST['search-client-select-client'])) {
    $clientId = $_POST['search-client-select-client'];
    CtlSelectClient($clientId);
    CtlChangeView('agent-client-overview');
} else if (isset($_POST['employeId'])){
    $employeId = $_POST['employeId'];
    $employe = CtlAdvisorOfClient($employeId);
   
}else if (isset($_POST['submit-overview-changes'])){
        $name = $_POST['input-name'];
        $firstName = $_POST['input-first-name'];
        $clientId =$_POST['input-client-id']; 
        $adress = $_POST['input-adress'];
        $birthday = $_POST['input-birthday'];
        $mail = $_POST['input-mail'];
        $phoneNumber = $_POST['input-phone-number'] ;
        $situation = $_POST['input-situation'];
        $work = $_POST['input-work'];
        $checked = $_POST['input-checked'];
        $advisorId =$_POST['input-advisor-id']; 
        CtlModifyClient($name,$firstName,$clientId,$adress,$birthday,$mail,$phoneNumber,$situation,$work,$checked,$advisorId);
} else if (isset($_POST['calendar-event'])) {
    $eventId = $_POST['calendar-event'];
    $event = getEventById($eventId);
    $clientId = $event->NUMCLIENT;
    CtlSelectClient($clientId);
    $_SESSION['currentEvent'] = $event;
    CtlChangeView('advisor-client-documents');
} else if (isset($_POST['planning-prev-week'])) {
    CtlPlanningPrevWeek();
} else if (isset($_POST['planning-next-week'])) {
    CtlPlanningNextWeek();
}else if (isset($_POST['selectAdvisorToViewPlanning']) || isset($_POST['planning-select-date'])) {
    $advisorId = $_POST['selectAdvisorToViewPlanning'];
    $_SESSION['advisorToViewPlanning'] = getEmployeeById($advisorId);
    $_SESSION['calendarDay'] = $_POST['planning-select-date'];
} 


if ($_SESSION['loggedIn'] == false) {
    CtlDisplayLoginPage();
} else {
    CtlDisplayPage();
}