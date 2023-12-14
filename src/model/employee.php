employe.php



<?php
require_once 'connection.php';

function searchEmployeeById($employeId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE NUMEMPLOYE = :employeId LIMIT 1');
    $result->execute(array(
        'employeId' => $employeId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $employe = $result->fetch();
    $result->closeCursor();

    if (empty($employe)) {
        return null;
    }

    return $employe;
}