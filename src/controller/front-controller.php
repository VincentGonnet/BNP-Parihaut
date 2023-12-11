<?php

require_once 'controller/controller.php';

if(isset($_POST['connection'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    CtlLogin($login, $password);
} else if (isset($_POST['logout'])) {
    CtlLogout();
} else if (isset($_POST['agent-search-client'])) {
    CtlChangeView('agent-search-client');
} else if (isset($_POST['agent-client-overview'])) {
    CtlChangeView('agent-client-overview'); 
} else if (isset($_POST['agent-client-accounts'])) {
    CtlChangeView('agent-client-accounts'); 
} else if (isset($_POST['agent-client-contracts'])) {
    CtlChangeView('agent-client-contracts'); 
} else if (isset($_POST['agent-client-appointments'])) {
    CtlChangeView('agent-client-appointments'); 
} else if (isset($_POST['director-manage-account-types'])) {
    CtlChangeView('director-manage-account-types');
}

if($_SESSION['loggedIn'] == false) {
    CtlDisplayLoginPage();
} else {
    CtlDisplayPage();
}