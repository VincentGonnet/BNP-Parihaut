<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'view/view.php';
session_start();

require_once 'model/compte.php';
require_once 'model/contrat.php';
require_once 'model/user.php';
require_once 'model/client.php';
require_once 'model/reason.php';
require_once 'model/event.php';
require_once 'model/employee.php';
require_once 'controller/router.php';
require_once 'model/employee.php';
require_once 'model/documents.php';
require_once 'model/client-account.php';
require_once 'model/clientContract.php';



// LOGIN FUNCTIONS -------------------------------------------------------------

if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}

function CtlLogin($login, $password) {
    $user = logIn($login, $password);
    // TODO: if user is null, display error message (wrong credentials)
}

function CtlModifyCredentials($employeeId, $login, $password) {
    modifyCredentials($employeeId, $login, $password);
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
    deleteDocumentByName($accountName);
}

function CtlAddAccount($accountName,$overdraft){
    if (empty(getDocumentByName($accountName))) {
        addAccount($accountName,$overdraft);
    CtlAddDocument($accountName , '');
    } else {
        echo '<script>alert("Un contrat ou un compte avec le même nom existe déjà")</script>';
    }
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
    deleteDocumentByName($contract);
}

function CtlAddContract($contract) {
    if (empty(getDocumentByName($contract))) {
        addContract($contract);
        CtlAddDocument($contract , '');
    } else {
        echo '<script>alert("Un contrat ou un compte avec le même nom existe déjà")</script>';
    }
}

function CtlDeleteAllContracts(){
    deleteAllContracts();
}


//AFFICHAGE MOTIF

function CtlGetAllDocuments(){
    $documentsList=getAllDocuments();
    $_SESSION['showAllDocuments']= $documentsList;
}

function CtlDeleteDocument($DocumentID){
    deleteDocument($DocumentID);
}

function CtlAddDocument($document , $list){
    addDocument($document , $list);
}

function CtlModifyDocumentByName($document , $list){
    modifyDocumentByName($document , $list);
}

function CtlEditList($document , $list , $iddoc){
    editList($document , $list , $iddoc);
}

function CtlGetDocument($documentId){
    $document=getDocument($documentId);
    $_SESSION['required-docs']=$document;
}





//AJOUTER UN EMPLOYE

function CtlAddEmployee($name , $firstname , $job , $login , $password){
    addEmployee($name , $firstname , $job , $login , $password);
}


/*---------Overview fonctions--*/

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

function CtlModifyClientAgent($name,$firstName,$clientId,$adress,$birthday,$mail,$phoneNumber,$situation,$work){
    modifyClientAgent($name,$firstName,$clientId,$adress,$birthday,$mail,$phoneNumber,$situation,$work);
}
function CtlModifyClientAdvisor($checked,$clientId){
    modifyClientAdvisor($checked,$clientId);
    

}

function CtlGetAccountData($clientId){
   getAccountData($clientId);
}
function CtlGetContractData($clientId){
    getContractData($clientId);
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

function CtlDeleteEvent($eventId) {
    deleteEvent($eventId);
}

function CtlReserveTimeSlot($start, $end) {
    $employee = $_SESSION['loggedInUser'];
    reserveTimeSlot($employee->NUMEMPLOYE, $start, $end);
}

// ADVISOR FUNCTIONS ----------------------------------------------------------

function CtlSelectEvent($eventId) {
    $event = getEventById($eventId);
    $_SESSION['currentEvent'] = $event;

}

function CtlGetAllAccountsClient($idClient){
    $accounts = getAllAccountsClient($idClient);
    $_SESSION['client-accounts']=$accounts;
}

function CtlEditOverdraft($accountName , $idClient , $overdraft){
    editOverdraft($accountName , $idClient , $overdraft);
}

function CtlNewAccount($idClient , $accountName , $openDate , $balance , $overdraft){
    newAccount($idClient , $accountName , $openDate , $balance , $overdraft);
}

function CtlCloseAccount($idClient , $accountName , $endDate){
    $account = getClientAccount($idClient, $accountName);
    $balance = $account->SOLDE;
    if ($balance != 0) {
        echo '<script>alert("Le solde du compte doit être nul pour le fermer")</script>';
    } else {
        closeAccount($idClient , $accountName , $endDate);
    }
}
function CtlClientNewContract($idClient,$openingDate,$endDate,$price,$contractType){
    clientNewContract($idClient,$openingDate,$endDate,$price,$contractType);
}
function CtlDeleteClientContract($idClient,$contractType){
    closeContract($contractType, $idClient, date('Y-m-d'));
}



// DIRECTOR FUNCTIONS ---------------------------------------------------------

function CtlModifyJob($employeeId, $job) {
    modifyEmployeeJob($employeeId, $job);
}

function CtlLoadStats() {
    if (empty($_SESSION['stats-contract-dates'])) {
        $_SESSION['stats-contract-dates'] = [date('Y-m-d'), date('Y-m-d', strtotime('-1 month'))];
    }
    if (empty($_SESSION['stats-appointment-dates'])) {
        $_SESSION['stats-appointment-dates'] = [date('Y-m-d'), date('Y-m-d', strtotime('-1 month'))];
    }
    if (empty($_SESSION['stats-clients-dates'])) {
        $_SESSION['stats-client-dates'] = [date('Y-m-d'), date('Y-m-d', strtotime('-1 month'))];
    }
    if (empty($_SESSION['stats-balance-dates'])) {
        $_SESSION['stats-balance-dates'] = [date('Y-m-d'), date('Y-m-d', strtotime('-1 month'))];
    }
}

// ADD CLIENT FUNCTIONS --------------------------------------------------------

function CtlAddNewClient($name, $firstName, $email, $phone, $street, $city, $zip,$country, $advisorId,$situation,$work,$birthday) {
    $address = $street . ', ' . $zip . ' ' . $city . ', ' . $country;
    $newClientId = addNewClient($name, $firstName, $email, $phone, $address, $advisorId,$situation,$work,$birthday);
    $_SESSION['currentClient'] = searchClientById($newClientId);
    $_SESSION['currentPage'] = 'agent-client-appointments';
}
