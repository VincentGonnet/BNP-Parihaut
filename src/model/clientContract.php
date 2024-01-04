<?php

function getAllContractsBeforeDate($date) {
    $connection = Connection::getInstance()->getConnection();
    $request = $connection->prepare("SELECT * FROM contratclient WHERE DATEOUVERTURECONTRAT < :date");
    $request->execute(array(
        'date' => $date
    ));
    $request->setFetchMode(PDO::FETCH_OBJ);
    $contracts = $request->fetchAll();
    $request->closeCursor();

    if(empty($contracts)) {
        return null;
    }

    if(!is_array($contracts)) {
        $contracts = array($contracts);
    }

    return $contracts;
}