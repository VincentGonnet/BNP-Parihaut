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
    $request="select * from motif where IDMOTIF LIKE :documentId LIMIT 1";
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'documentId' => $documentId
    ));
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $desc = $prepare->fetchall();
    $prepare->closeCursor();

    if (empty($desc)){
        return null;
    }

    if (is_array($desc)){
        $desc = $desc[0];
    }

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


function allDocsChecked(){
    return true;
}

/**
 * This function returns an array of strings containing the documents required for a given reason.
 * @param $reasonId
 * @return array|null
 */
function getDocumentsAsArray($reasonId) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM motif WHERE IDMOTIF = :reasonId LIMIT 1');
    $result->execute(array(
        'reasonId' => $reasonId
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $reason = $result->fetch();
    $result->closeCursor();

    if(empty($reason)) {
        return null;
    }

    $documents = array();

    if ($reason->LISTEPIECES != null) {
        $documents = explode(',', $reason->LISTEPIECES);
    } else {
        return null;
    }

    // format so that the first letter is uppercase and the rest is lowercase
    foreach ($documents as $key => $document) {
        $documents[$key] = ucfirst(mb_strtolower($document));
    }

    return $documents;
}


