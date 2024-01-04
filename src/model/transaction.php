<?php

function getAllTransactionsBeforeDate($date) {
    $connection = Connection::getInstance()->getConnection();
    $request = $connection->prepare("SELECT * FROM operation WHERE DATEOP <= :date");
    $request->execute(array(
        'date' => $date
    ));
    $request->setFetchMode(PDO::FETCH_OBJ);
    $transations = $request->fetchAll();
    $request->closeCursor();

    if(empty($transations)) {
        return null;
    }

    if(!is_array($transations)) {
        $transations = array($transations);
    }

    return $transations;
}