<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
    if (isset($_POST['redirect-director-manage-documents'])) {
        CtlGetAllDocuments();
    }
    if (isset($_POST['redirect-advisor-client-accounts'])) {
        $idClient = $_SESSION['currentEvent']->NUMCLIENT;
        CtlGetAllAccountsClient($idClient);
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
    CtlChangeView('agent-client-overview');
} 
//MANAGE-ACCOUNT-TYPES
 else if(isset($_POST['delete-account'])){
        $compte = $_POST['delete-account'];
        CtlDeleteAccount($compte);
        CtlGetAllAccounts(); 
} else if(isset($_POST['add-account'])){
    if(!empty($_POST['new-account'])){
        $compte=$_POST['new-account'];
        CtlAddAccount($compte);
        CtlGetAllAccounts();  
    }
} 
//MANAGE-CONTRACT-TYPES
else if(isset($_POST['delete-contract'])){
        $contrat = $_POST['delete-contract'];
        CtlDeleteContract($contrat);
        CtlGetAllContracts();
    }
            
 else if(isset($_POST['add-contract'])){
    if(!empty($_POST['new-contract'])){
        $contrat=$_POST['new-contract'];
        CtlAddContract($contrat);
        CtlGetAllContracts();  
    }
} 

//ADD-EMPLOYE
  else if(isset($_POST['register-new-employee'])){
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $job = $_POST['job'];
    CtlAddEmployee($name , $firstname , $login , $password , $job);
} else if (isset($_POST['submit-overview-changes'])){
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
} else if (isset($_POST['selectAdvisorToViewPlanning']) || isset($_POST['planning-select-date'])) {
    if (isset($_POST['selectAdvisorToViewPlanning'])) {
        $advisorId = $_POST['selectAdvisorToViewPlanning'];
        $_SESSION['advisorToViewPlanning'] = getEmployeeById($advisorId);
    }
    $_SESSION['calendarDay'] = $_POST['planning-select-date'];
} else if (isset($_POST['add-event'])) {
    $startDate = $_POST["new-event-start-time"];
    $duration = $_POST["new-event-duration"];
    $reasonId = $_POST["new-event-reason"];
    $start = date('Y-m-d H:i:s', strtotime($startDate));
    $end = date('Y-m-d H:i:s', strtotime($startDate . ' + ' . $duration[0] . $duration[1] . ' hours ' . $duration[3] . $duration[4] . ' minutes '));
    CtlAddEvent($start, $end, $reasonId);
} else if (isset($_POST["delete-event"])) {
    $eventId = $_POST["delete-event"];
    CtlDeleteEvent($eventId);
}
// MANAGE EMPLOYEE
else if (isset($_POST["submit-manage-employee"])) {
    $employeeId = $_POST["submit-manage-employee"];
    $_SESSION['employeeToManage'] = getEmployeeById($employeeId);
    CtlChangeView('director-employee-overview');
} else if (isset($_POST["modify-login-infos"])) {
    $employeeId = $_SESSION['employeeToManage']->NUMEMPLOYE;
    $login = $_POST["login"];
    $password = $_POST["password"];
    CtlModifyCredentials($employeeId, $login, $password);
    $_SESSION['employeeToManage'] = getEmployeeById($employeeId);
}else if (isset($_POST["modify-general-infos"])) {
    $employeeId = $_SESSION['employeeToManage']->NUMEMPLOYE;
    $job = $_POST["job"];
    CtlModifyJob($employeeId, $job);
    $_SESSION['employeeToManage'] = getEmployeeById($employeeId);
}

 

//MANAGE-DOCUMENTS

  else if (isset($_POST['delete-document'])){
    $DocumentID= $_POST['delete-document'];
    CtlDeleteDocument($DocumentID);
    CtlGetAllDocuments();

}  else if(isset($_POST['add-document'])){
    if(!empty($_POST['new-doc'] && !empty($_POST['new-list']))){
        $document=$_POST['new-doc'];
        $list=$_POST['new-list'];
        CtlAddDocument($document , $list);
    }
    CtlGetAllDocuments();
} 

//ADVISOR ACCOUNTS 
 else if(isset($_POST['edit-overdraft'])){
    $accountName=$_POST['edit-overdraft'];
    $idClient=$_SESSION['currentClient']->NUMCLIENT;
    CtlGetOverdraft($accountName,$idClient);
 }

if ($_SESSION['loggedIn'] == false) {
    CtlDisplayLoginPage();
} else {
    CtlDisplayPage();
}