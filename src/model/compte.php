<?php



function getAllAccounts(){
    $connection = Connection::getInstance()->getConnection(); 
    $request="select * from compte " ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array());
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $desc = $prepare->fetchall();
    $prepare->closeCursor();
    return $desc;
}


function  getAccount($accountName){
    $connection= Connection::getInstance()->getConnection();
    $request="select NOMCOMPTE from compte where NOMCOMPTE='$accountName'" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array());
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();
    return $result;
}

function deleteAccount($accountName){
    $connection= Connection::getInstance()->getConnection();
    $request="delete from compte where NOMCOMPTE='$accountName'" ;
    $prepare=$connection->prepare($request);
    $prepare->execute();
    $prepare->closeCursor();
}



function addAccount($accountName){
    $connection= Connection::getInstance()->getConnection();
    $request="INSERT IGNORE INTO compte (NOMCOMPTE) VALUES ('$accountName')" ;
    $prepare=$connection->prepare($request);
    $prepare->execute();
    $prepare->closeCursor();
}

function deleteAllAccounts(){
    $connection= Connection::getInstance()->getConnection();
    $request="DELETE from compte" ;
    $result=$connection->query($request);
    $result->closeCursor();
}

