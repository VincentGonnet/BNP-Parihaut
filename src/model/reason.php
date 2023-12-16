<?php

function getReasonById($reasonId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM motif WHERE IDMOTIF = :reasonId LIMIT 1');
    $result->execute(array(
        'reasonId' => $reasonId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $reason = $result->fetch();
    $result->closeCursor();

    if(empty($reason)) {
        return null;
    }

    return $reason;
}