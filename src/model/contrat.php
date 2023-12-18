<?php



function getAllContracts(){
    $connection = Connection::getInstance()->getConnection(); 
    $request="select * from contrat " ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array());
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();
    return $result;
}


function  getContract($contractName){
    $connection= Connection::getInstance()->getConnection();
    $request="select NOMCONTRAT from contrat where NOMCONTRAT like :contractName" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'contractName' => $contractName
    ));
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();
    return $result;
}

function deleteContract($contractName){
    $connection= Connection::getInstance()->getConnection();
    $request="delete from contrat where NOMCONTRAT LIKE :contractName" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'contractName' => $contractName
    ));
    $prepare->closeCursor();
}



function addContract($contractName){
    $connection= Connection::getInstance()->getConnection();
    $request="INSERT IGNORE INTO contrat (NOMCONTRAT) VALUES ( :contractName)" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'contractName' => $contractName
    ));
    $prepare->closeCursor();
}

function deleteAllContracts(){
    $connection= Connection::getInstance()->getConnection();
    $request="DELETE from contrat" ;
    $result=$connection->query($request);
    $result->closeCursor();
}

