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

function getAllReasons() {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM motif');
    $result->execute();
    $result->setFetchMode(PDO::FETCH_OBJ);
    $reasons = $result->fetchAll();
    $result->closeCursor();

    if(empty($reasons)) {
        return null;
    }

    if (!is_array($reasons)) {
        $reasons = array($reasons);
    }

    return $reasons;
}