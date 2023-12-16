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

function getFormattedClientName($client) {
    return $client->NOM . ' ' . $client->PRENOM;
}