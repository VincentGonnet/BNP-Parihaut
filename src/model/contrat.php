<?php



function showContracts(){
    $connection = Connection::getInstance()->getConnection(); 
    $request="select * from contrat " ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array());
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();
    return $result;
}


function  showOneContract($contrat){
    $connection= Connection::getInstance()->getConnection();
    $request="select NOMCONTRAT from contrat where NOMCONTRAT='$contrat'" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array());
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();
    return $result;
}

function deleteContract($contract){
    $connection= Connection::getInstance()->getConnection();
    $request="delete from contrat where NOMCONTRAT='$contract'" ;
    $prepare=$connection->prepare($request);
    $prepare->execute();
    $prepare->closeCursor();
}



function addContract($contrat){
    $connection= Connection::getInstance()->getConnection();
    $request="INSERT IGNORE INTO contrat (NOMCONTRAT) VALUES ('$contrat')" ;
    $prepare=$connection->prepare($request);
    $prepare->execute();
    $prepare->closeCursor();
}

function deleteAllContracts(){
    $connection= Connection::getInstance()->getConnection();
    $request="DELETE from contrat" ;
    $prepare=$connection->prepare($request);
    $prepare->execute();
    $prepare->closeCursor();
}

