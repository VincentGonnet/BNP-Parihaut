<?php



function getAllDocuments(){
    $connection = Connection::getInstance()->getConnection(); 
    $request="select * FROM MOTIF " ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array());
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $desc = $prepare->fetchall();
    $prepare->closeCursor();
    return $desc;
}


function deleteDocument($DocumentID){
    $connection= Connection::getInstance()->getConnection();
    $request="delete from motif where IDMOTIF LIKE :DocumentID";
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'DocumentID' => $DocumentID
    ));
    $prepare->closeCursor();
}