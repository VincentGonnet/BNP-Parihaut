<?php
require_once 'connection.php';

/**
 * @param $login String
 * @param $password String
 * @return mixed
 */
function logIn($login, $password) {
    // Get the user from the database
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM employe WHERE LOGIN = :login AND MDP = :password');
    $result->execute(array(
        'login' => $login,
        'password' => $password
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $user = $result->fetch();
    $result->closeCursor();

    // If the user is not found (wrong login/password), return null
    if(empty($user)) {
        return null;
    }

    $_SESSION['loggedIn'] = true; // Set the loggedIn flag to true in the session
    $_SESSION['loggedInUser'] = $user; // Store the user in the session

    if ($user->CATEGORIE == "advisor") {
        $_SESSION['advisorToViewPlanning'] = $user;
    }

    return $user;


    // If the user is found, check the password
    // if(verifyPassword($password, $user->PASSWORD)) {
    //     $_SESSION['loggedIn'] = true; // Set the loggedIn flag to true in the session
    //     $_SESSION['loggedInUser'] = $user; // Store the user in the session
    //     return $user;
    // } else {
    //     return null;
    // }
}

// function verifyPassword($givenPasseword, $userPassword) {
//     return password_verify($givenPasseword, $userPassword);
// }

function isLoggedIn() {
    if(isset($_SESSION['loggedIn'])) {
        return $_SESSION['loggedIn'];
    } else {
        return false;
    }
}

function getLoggedInUser() {
    if(isset($_SESSION['loggedInUser'])) {
        return $_SESSION['loggedInUser'];
    } else {
        return null;
    }
}

function modifyCredentials($employeeId, $login, $password) {
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('UPDATE employe SET LOGIN = :login, MDP = :password WHERE NUMEMPLOYE = :employeeId');
    $result->execute(array(
        'login' => $login,
        'password' => $password,
        'employeeId' => $employeeId
    ));
    $result->closeCursor();
}