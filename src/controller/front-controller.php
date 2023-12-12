<?php

require_once 'controller/controller.php';

if(isset($_POST['connection'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    CtlLogin($login, $password);
} else if(isset($_POST['logout'])) {
    CtlLogout();
} else if(isset($_POST['agent-search-client'])) {
    CtlChangeView('agent-search-client');
} else if(isset($_POST['agent-client-overview'])) {
    CtlChangeView('agent-client-overview');
} else if(isset($_POST['agent-client-accounts'])) {
    CtlChangeView('agent-client-accounts');
} else if(isset($_POST['agent-client-contracts'])) {
    CtlChangeView('agent-client-contracts');
} else if(isset($_POST['agent-client-appointments'])) {
    CtlChangeView('agent-client-appointments');
} else if(isset($_POST['advisor-planning'])) {
    CtlChangeView('advisor-planning');
} else if(isset($_POST['advisor-client-documents'])) {
    CtlChangeView('advisor-client-documents');
} else if(isset($_POST['advisor-client-overview'])) {
    CtlChangeView('advisor-client-overview');
} else if(isset($_POST['advisor-client-accounts'])) {
    CtlChangeView('advisor-client-accounts');
} else if(isset($_POST['advisor-client-contracts'])) {
    CtlChangeView('advisor-client-contracts');
} else if(isset($_POST['advisor-client-appointments'])) {
    CtlChangeView('advisor-client-appointments');
} else if(isset($_POST['director-manage-employees'])) {
    CtlChangeView('director-manage-employees');
} else if(isset($_POST['director-add-employee'])) {
    CtlChangeView('director-add-employee');
} else if(isset($_POST['director-manage-account-types'])) {
    CtlChangeView('director-manage-account-types');
} else if(isset($_POST['director-manage-contract-types'])) {
    CtlChangeView('director-manage-contract-types');
} else if(isset($_POST['director-see-stats'])) {
    CtlChangeView('director-see-stats');
} else if(isset($_POST['agent-search-client-by-id'])) {
    $clientId = $_POST['client-id'];
    CtlSearchClientById($clientId);
} else if(isset($_POST['agent-search-client-by-name'])) {
    $clientName = $_POST['client-name'];
    $clientFirstName = $_POST['client-firstname'];
    CtlSearchClientByName($clientName, $clientFirstName);
} else if(isset($_POST['search-client-select-client'])) {
    $clientId = $_POST['search-client-select-client'];
    CtlSelectClient($clientId);
}

if($_SESSION['loggedIn'] == false) {
    CtlDisplayLoginPage();
} else {
    CtlDisplayPage();
}