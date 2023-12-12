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