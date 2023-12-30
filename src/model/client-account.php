<?php

function getAllAccountsClient($idClient){
    $connection = Connection::getInstance()->getConnection(); 
    $request="select * from compteclient where NUMCLIENT LIKE :idClient AND DATEFERMETURE IS NULL" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'idClient' => $idClient
    ));
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $desc = $prepare->fetchall();
    $prepare->closeCursor();
    return $desc;
}

function getOverdraft($accountName , $idClient){
    $connection= Connection::getInstance()->getConnection();
    $request="select * from compteclient where NOMCOMPTE LIKE :accountName and NUMCLIENT like :idClient" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'accountName' => $accountName ,
        'idClient' => $idClient
    ));
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();
    return $result;
}