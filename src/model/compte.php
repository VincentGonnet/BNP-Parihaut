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


function getAccount($accountName){
    $connection= Connection::getInstance()->getConnection();
    $request="select NOMCOMPTE from compte where NOMCOMPTE LIKE :accountName" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'accountName' => $accountName
    ));
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();
    return $result;
}

function deleteAccount($accountName){
    $connection= Connection::getInstance()->getConnection();
    $request="delete from compte where NOMCOMPTE LIKE :accountName";
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'accountName' => $accountName
    ));
    $prepare->closeCursor();
}

function getAccountbyName($accountName){
    $connection= Connection::getInstance()->getConnection();
    $request="select * from compte where NOMCOMPTE LIKE :accountName LIMIT 1" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'accountName' => $accountName
    ));
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $result = $prepare->fetchall();
    $prepare->closeCursor();

    if (empty($result)){
        return null;
    }

    if (is_array($result)){
        $result = $result[0];
    }

    return $result;
}



function addAccount($accountName,$overdraft){
    $connection= Connection::getInstance()->getConnection();
    $request="INSERT IGNORE INTO compte (NOMCOMPTE,AVOIRDECOUVERT) VALUES ( :accountName, :overdraft)" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'accountName' => $accountName,
        'overdraft' => $overdraft
    ));
    $prepare->closeCursor();
}

function deleteAllAccounts(){
    $connection= Connection::getInstance()->getConnection();
    $request="DELETE from compte" ;
    $result=$connection->query($request);
    $result->closeCursor();
}


