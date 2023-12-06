<?php
require_once 'connection.php';

/**
 * @param $username String
 * @param $password String
 * @return mixed
 */
function logIn($username, $password) {
    // Get the user from the database
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('SELECT * FROM users WHERE USERNAME = :username');
    $result->execute(array(
        'username' => $username
    ));
    $result->setFetchMode(PDO::FETCH_OBJ);
    $user = $result->fetch();
    $result->closeCursor();

    // If the user is not found (wrong username), return null
    if(empty($user))
        return null;

    // If the user is found, check the password
    if(verifyPassword($password, $user->PASSWORD)) {
        $_SESSION['loggedIn'] = true; // Set the loggedIn flag to true in the session
        $_SESSION['loggedInUser'] = $user; // Store the user in the session
        return $user;
    } else {
        return null;
    }
}

function verifyPassword($givenPasseword, $userPassword) {
    return password_verify($givenPasseword, $userPassword);
}

function isLoggedIn() {
    if(isset($_SESSION['loggedIn'])) {
        return $_SESSION['loggedIn'];
    } else {
        return false;
    }
}

function logOut() {
    $_SESSION['loggedIn'] = false;
}

function getLoggedInUser() {
    if(isset($_SESSION['loggedInUser'])) {
        return $_SESSION['loggedInUser'];
    } else {
        return null;
    }
}

function addUser($username, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $connection = Connection::getInstance()->getConnection();
    $result = $connection->prepare('INSERT INTO employe (USERNAME, PASSWORD) VALUES (:username, :password)');
    $result->execute(array(
        'username' => $username,
        'password' => $hashedPassword
    ));
    $result->closeCursor();
}