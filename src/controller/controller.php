<?php
require_once 'view/view.php';
session_start();

require_once 'model/compte.php';
require_once 'model/contrat.php';
require_once 'model/user.php';
require_once 'model/client.php';
require_once 'controller/router.php';
require_once 'model/employee.php';



// LOGIN FUNCTIONS -------------------------------------------------------------

if(!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}

function CtlLogin($login, $password) {
    $user = logIn($login, $password);
    // TODO: if user is null, display error message (wrong credentials)
}

function CtlLogout() {
    session_unset();
    $_SESSION['loggedIn'] = false;
}



// PAGE DISPLAY FUNCTIONS ------------------------------------------------------

function CtlChangeView($route) {
    $_SESSION['currentPage'] = $route;
}

function CtlDisplayLoginPage() {
    displayLoginPage();
}

function CtlDisplayPage() {
    if(!isset($_SESSION['loggedInUser'])) {
        $_SESSION['loggedIn'] = false;
        displayLoginPage();
        return;
    }

    if(!isset($_SESSION['currentPage'])) {
        if($_SESSION['loggedInUser']->CATEGORIE == 'agent') {
            $_SESSION['currentPage'] = 'agent-search-client';
        } else if($_SESSION['loggedInUser']->CATEGORIE == 'advisor') {
            $_SESSION['currentPage'] = 'advisor-planning';
        } else if($_SESSION['loggedInUser']->CATEGORIE == 'director') {
            $_SESSION['currentPage'] = 'director-manage-employees';
        }
    }

    displayRoute($_SESSION['currentPage']);
}

function CtlGlobalLayout() {
    require_once 'view/global-layout.php';
}



// AGENT FUNCTIONS -------------------------------------------------------------

function CtlSearchClientById($clientId) {
    $client = searchClientById($clientId); // returns a single client, or null
    if($client == null) {
        unset($_SESSION['currentClient']);
    } else {
        CtlSearchClientSetResults(array($client));
    }
}

function CtlSearchClientByName($name, $firstName) {
    $clients = searchClientByName($name, $firstName); // returns an array of clients, or null
    if($clients == null) {
        unset($_SESSION['currentClient']);
    } else {
        CtlSearchClientSetResults($clients);
    }
}

function CtlSearchClientSetResults($clients) {
    $_SESSION['searchClientResults'] = $clients;
}

function CtlSelectClient($clientId) {
    $client = searchClientById($clientId);
    $_SESSION['currentClient'] = $client;
    $_SESSION['currentPage'] = 'agent-client-overview';
}

//AFFICHAGE COMPTES

function CtlGetAllAccounts(){
    $accountsList=getAllAccounts();
    $_SESSION['showAllAccounts']= $accountsList;
}

function CtlGetAccount($accountName){
    $account = getAccount($accountName);
    $_SESSION['showAllAccounts']=$account;
}

function CtlDeleteAccount($accountName){
    deleteAccount($accountName);
}

function CtlAddAccount($accountName){
    addAccount($accountName);
}

function CtlDeleteAllAccounts(){
    deleteAllAccounts();
}

//AFFICHAGE CONTRATS

function CtlGetAllContracts(){
    $contractsList=getAllContracts();
    $_SESSION['showAllContracts']= $contractsList;
}

function CtlGetContract($contract){
    $contract = getContract($contract);
    $_SESSION['showAllContracts']=$contract;
}

function CtlDeleteContract($contract){
    deleteContract($contract);
}

function CtlAddContract($contract){
    addContract($contract);
}

function CtlDeleteAllContracts(){
    deleteAllContracts();
}

//AJOUTER UN EMPLOYE

function CtlAddEmployee($name , $firstname , $job , $login , $password){
    addEmployee($name , $firstname , $job , $login , $password);
}