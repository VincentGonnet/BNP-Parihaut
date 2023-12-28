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