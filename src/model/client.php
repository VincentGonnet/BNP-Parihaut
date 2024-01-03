<?php
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


function modifyClientAgent($name,$firstName,$clientId,$adress,$birthday,$mail,$phoneNumber,$situation,$work) {
    $connection = Connection::getInstance()->getConnection();
     $result = $connection->prepare('UPDATE client SET NOM=:name, PRENOM=:firstName, ADRESSE=:adress, MAIL=:mail, NUMTEL=:phoneNumber, PROFESSION=:work, SITUATION=:situation, DATENAISSANCE=:birthday WHERE NUMCLIENT=:clientId');
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
 }
 function modifyClientAdvisor($checked,$clientId){
    
    
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('UPDATE client SET ENREGISTRE =:checked  WHERE NUMCLIENT=:clientId');
    $result->execute(array(
     'checked' =>$checked,
     'clientId' => $clientId
    ));
    $result->closeCursor();
    $_SESSION['currentClient']->ENREGISTRE=$checked;
 }
 

function getFormattedClientName($client) {
    return $client->NOM . ' ' . $client->PRENOM;
}

