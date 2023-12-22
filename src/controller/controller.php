<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'view/view.php';
session_start();

require_once 'model/user.php';
require_once 'model/client.php';
require_once 'model/reason.php';
require_once 'model/event.php';
require_once 'model/employee.php';
require_once 'controller/router.php';
require_once 'model/employee.php';



// LOGIN FUNCTIONS -------------------------------------------------------------

if (!isset($_SESSION['loggedIn'])) {
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

function CtlAdvisorOfClient($clientId){
    $client = searchClientById($clientId);
    if ($client) {
        $employeId = $client->NUMEMPLOYE;
        $employe = getEmployeeById($employeId);
        return $employe;
    } else {
        return null;
    }
}

function CtlModifyClient($name,$firstName,$clientId,$adress,$birthday,$mail,$phoneNumber,$situation,$work,$checked,$advisorId){
    modifyClient($name,$firstName,$clientId,$adress,$birthday,$mail,$phoneNumber,$situation,$work,$checked,$advisorId);
}

function CtlGetAccountData($clientId){
   getAccountData($clientId);
}
function CtlGetContractData($clientId){
    getContractData($clientId);
 }
function CtlModifyDecouvert($decouvert,$clientId,$accountType){
    
    modifyDecouvert($decouvert,$clientId,$accountType);
}
function CtlCredit($ammount,$clientId,$accountType){
    credit($ammount,$clientId,$accountType);
}
function CtlDebit($ammount,$clientId,$accountType){
    debit($ammount,$clientId,$accountType);
}

// PLANNING FUNCTIONS ----------------------------------------------------------

function CtlPlanningNextWeek() {
    $_SESSION['calendarDay'] = date('Y-m-d', strtotime($_SESSION['calendarDay'] . ' + 7 days'));
}

function CtlPlanningPrevWeek() {
    $_SESSION['calendarDay'] = date('Y-m-d', strtotime($_SESSION['calendarDay'] . ' - 7 days'));
}

function CtlAddEvent($start, $end, $reasonId) {
    $client = $_SESSION['currentClient'];
    addEvent($client->NUMEMPLOYE, $client->NUMCLIENT, $reasonId, $start, $end);
}

// ADVISOR FUNCTIONS ----------------------------------------------------------

function CtlSelectEvent($eventId) {
    $event = getEventById($eventId);
    $_SESSION['currentEvent'] = $event;
}