<?php

require_once 'controller/controller.php';

$postKey = array_keys($_POST)[0];
if (explode('-', $postKey)[0] == "redirect") {  // if first part of the key is "redirect", then redirect to the route specified in the key
    $route = array_slice(explode('-', $postKey), 1);
    CtlChangeView(implode('-', $route));

    // additional actions on specific routes
    if (isset($_POST['redirect-director-manage-account-types'])) {
        CtlShowAccounts();
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
    CtlShowAccounts();        
} else if(isset($_POST['add-account'])){
    if(!empty($_POST['account'])){
        $compte=$_POST['account'];
        CtlAddAccount($compte);
        CtlShowAccounts();  
    }
} else if(isset($_POST['delete-all-accounts'])){
    CtlDeleteAllAccounts();
    CtlShowAccounts();
}
//MANAGE-CONTRACT-TYPES
else if(isset($_POST['delete-contract'])){
    if(!empty($_POST['radio-contract'])){
        $contrat = $_POST['radio-contract'];
        CtlDeleteContract($contrat);
    }
    CtlShowContracts();        
} else if(isset($_POST['add-contract'])){
    if(!empty($_POST['contract'])){
        $contrat=$_POST['contract'];
        CtlAddContract($contrat);
        CtlShowContracts();  
    }
} else if(isset($_POST['delete-all-contracts'])){
    CtlDeleteAllContracts();
    CtlShowContracts();
}

if ($_SESSION['loggedIn'] == false) {
    CtlDisplayLoginPage();
} else {
    CtlDisplayPage();
}