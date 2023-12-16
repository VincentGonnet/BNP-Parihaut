<?php

function addEmployee($name , $firstname , $login , $password , $job){
    $connection= Connection::getInstance()->getConnection();
    $request="INSERT IGNORE INTO employe (NOM , PRENOM , LOGIN , MDP , CATEGORIE) VALUES ( :name , :firstname , :login , :password , :job  )" ;
    $prepare=$connection->prepare($request);
    $prepare->execute(array(
        'name' => $name ,
        'firstname' => $firstname ,
        'login' => $login ,
        'password' => $password ,
        'job' => $job
    ));
    $prepare->closeCursor();
}
