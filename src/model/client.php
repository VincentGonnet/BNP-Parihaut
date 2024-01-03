<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'connection.php';

/**
 * Returns a single client from the database, or null if not found.
 * @param $clientId string
 * @return mixed
 */
function searchClientById($clientId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM client WHERE NUMCLIENT = :clientId LIMIT 1');
    $result->execute(array(
        'clientId' => $clientId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $client = $result->fetch();
    $result->closeCursor();

    if(empty($client)) {
        return null;
    }

    return $client;
}

/**
 * Returns an array of clients from the database, or null if not found.
 * @param $name string
 * @param $firstName string
 * @return mixed
 */
function searchClientByName($name, $firstName) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM client WHERE NOM LIKE :name AND PRENOM LIKE :firstName');
    $result->execute(array(
        'name' => $name,
        'firstName' => $firstName
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $clients = $result->fetchAll();
    $result->closeCursor();

    if(empty($clients)) {
        return null;
    }

    if(!is_array($clients)) {
        $clients = array($clients);
    }

    return $clients;
}


function modifyClient($name,$firstName,$clientId,$adress,$birthday,$mail,$phoneNumber,$situation,$work,$checked,$advisorId) {
    $connection = Connection::getInstance()->getConnection();
     $result = $connection->prepare('UPDATE client SET NOM=:name, PRENOM=:firstName, ADRESSE=:adress, NUMCLIENT=:clientId, MAIL=:mail, NUMTEL=:phoneNumber, PROFESSION=:work, SITUATION=:situation, ENREGISTRE=:checked,DATENAISSANCE=:birthday WHERE NUMCLIENT=:clientId');
     $result->execute(array(
         'name' => $name,
         'firstName' => $firstName,
         'clientId' => $clientId,
         'adress' => $adress,
         'birthday' => $birthday, 
         'mail' => $mail,
         'phoneNumber' => $phoneNumber,
         'situation' => $situation,
         'work' => $work,
         'checked' => $checked,
         'advisorId' => $advisorId 
     ));
     $result->closeCursor();
     $_SESSION['currentClient']->NOM=$name ;
     $_SESSION['currentClient']->PRENOM =$firstName ;
     $_SESSION['currentClient']->NUMCLIENT =$clientId ;
     $_SESSION['currentClient']->ADRESSE=$adress;
     $_SESSION['currentClient']->DATENAISSANCE=$birthday ;
     $_SESSION['currentClient']->MAIL=$mail ;
     $_SESSION['currentClient']->NUMTEL =$phoneNumber ;
     $_SESSION['currentClient']->SITUATION =$situation ;
     $_SESSION['currentClient']->PROFESSION=$work ;
     $_SESSION['currentClient']->ENREGISTRE=$checked ;
     $_SESSION['currentClient']->NUMEMPLOYE=$advisorId;
 }
 

function getFormattedClientName($client) {
    return $client->NOM . ' ' . $client->PRENOM;
}
/******************************************Accounts****************************************************/
function getAccountData($clientId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM compteclient WHERE NUMCLIENT = :clientId');
    $result->execute(array(':clientId' => $clientId));

    $result->setFetchMode(PDO::FETCH_OBJ);
    $accounts = $result->fetchAll();
    $result->closeCursor();

    return $accounts;
}


function credit($ammount,$clientId,$accountType){
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('UPDATE compteclient SET SOLDE = SOLDE + :ammount WHERE NUMCLIENT = :clientId AND NOMCOMPTE = :accountType'); 
    $result->execute(array(
        ':clientId' => $clientId,
        ':ammount' => $ammount,
        ':accountType' => $accountType
    ));
}


function debit($ammount,$clientId,$accountType){
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('UPDATE compteclient SET SOLDE = SOLDE - :ammount WHERE NUMCLIENT = :clientId AND NOMCOMPTE = :accountType'); 
    $result->execute(array(
        ':clientId' => $clientId,
        ':ammount' => $ammount,
        ':accountType' => $accountType
    ));
    
}
function getContractData($clientId){
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM contratclient WHERE NUMCLIENT = :clientId');
    $result->execute(array(':clientId' => $clientId));

    $result->setFetchMode(PDO::FETCH_OBJ);
    $contract = $result->fetchAll();
    $result->closeCursor();
    
    return $contract;
}

function getAllClientsBeforeDate($date) {
    $connection = Connection::getInstance()->getConnection();
    $request = $connection->prepare("SELECT * FROM client WHERE DATEENREGISTREMENT <= :date");
    $request->execute(array(
        'date' => $date
    ));
    $request->setFetchMode(PDO::FETCH_OBJ);
    $clients = $request->fetchAll();
    $request->closeCursor();

    if(empty($clients)) {
        return null;
    }

    if(!is_array($clients)) {
        $clients = array($clients);
    }

    return $clients;
}