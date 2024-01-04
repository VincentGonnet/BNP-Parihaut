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

function editOverdraft($accountName , $idClient , $overdraft){
    $connection= Connection::getInstance()->getConnection();
    $request="UPDATE compteclient SET MONTANTDECOUVERT= :overdraft  WHERE NUMCLIENT= :idClient and NOMCOMPTE = :accountName" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'overdraft' => $overdraft ,
        'accountName' => $accountName ,
        'idClient' => $idClient
    ));
    $prepare->closeCursor();
}

function newAccount($idClient , $accountName , $openDate , $balance , $overdraft){
    $connection= Connection::getInstance()->getConnection();
    $request="INSERT IGNORE INTO compteclient (NUMCLIENT , NOMCOMPTE , DATEOUVERTURE , DATEFERMETURE, SOLDE , MONTANTDECOUVERT) VALUES (:idClient , :accountName , :openDate , NULL , :balance ,:overdraft  )" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'overdraft' => $overdraft ,
        'accountName' => $accountName ,
        'idClient' => $idClient ,
        'balance' => $balance ,
        'openDate' => $openDate
    ));
    $prepare->closeCursor();
}

function closeAccount($idClient , $accountName , $endDate){
    $connection= Connection::getInstance()->getConnection();
    $request="UPDATE compteclient SET DATEFERMETURE= :endDate  WHERE NUMCLIENT= :idClient and NOMCOMPTE = :accountName" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'idClient' => $idClient ,
        'accountName' => $accountName ,
        'endDate' => $endDate
    ));
    $prepare->closeCursor();
}