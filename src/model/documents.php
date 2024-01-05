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

function getDocument($documentId){
    $connection= Connection::getInstance()->getConnection();
    $request="select * from motif where IDMOTIF LIKE :documentId";
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'documentId' => $documentId
    ));
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

function addDocument($document , $list){
    $connection= Connection::getInstance()->getConnection();
    $request="INSERT IGNORE INTO motif (LIBELLEMOTIF , LISTEPIECES) VALUES ( :document , :list)" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'document' => $document ,
        'list' => $list
    ));
    $prepare->closeCursor();
}

function editList($document , $list , $iddoc){
    $connection= Connection::getInstance()->getConnection();
    $request="UPDATE motif SET LIBELLEMOTIF= :document , LISTEPIECES= :list WHERE IDMOTIF= :iddoc" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'document' => $document ,
        'list' => $list ,
        'idmotif' => $iddoc
    ));
    $prepare->closeCursor();
}

