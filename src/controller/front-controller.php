<?php

require_once 'controller/controller.php';

if (!empty($_POST)) {
    $postKey = array_keys($_POST)[0];
    if (explode('-', $postKey)[0] == "redirect") {  // if first part of the key is "redirect", then redirect to the route specified in the key
        $route = array_slice(explode('-', $postKey), 1);
        CtlChangeView(implode('-', $route));
      

    // additional actions on specific routes
    if (isset($_POST['redirect-director-manage-account-types'])) {
        CtlGetAllAccounts();
    }
    if (isset($_POST['redirect-director-manage-contract-types'])) {
        CtlGetAllContracts();
    }
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
} 
//MANAGE-ACCOUNT-TYPES
 else if(isset($_POST['delete-account'])){
    if(!empty($_POST['radio-account'])){
        $compte = $_POST['radio-account'];
        CtlDeleteAccount($compte);
    }
    CtlGetAllAccounts();        
} else if(isset($_POST['add-account'])){
    if(!empty($_POST['account'])){
        $compte=$_POST['account'];
        CtlAddAccount($compte);
        CtlGetAllAccounts();  
    }
} else if(isset($_POST['delete-all-accounts'])){
    CtlDeleteAllAccounts();
    CtlGetAllAccounts();
}
//MANAGE-CONTRACT-TYPES
else if(isset($_POST['delete-contract'])){
    if(!empty($_POST['radio-contract'])){
        $contrat = $_POST['radio-contract'];
        CtlDeleteContract($contrat);
    }
    CtlGetAllContracts();        
} else if(isset($_POST['add-contract'])){
    if(!empty($_POST['contract'])){
        $contrat=$_POST['contract'];
        CtlAddContract($contrat);
        CtlGetAllContracts();  
    }
} else if(isset($_POST['delete-all-contracts'])){
    CtlDeleteAllContracts();
    CtlGetAllContracts();
}
    CtlChangeView('agent-client-overview');
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