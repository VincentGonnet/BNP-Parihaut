<?php

require_once 'controller/controller.php';

if(isset($_POST['login'])) {
    // get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    CtlLogin($username, $password);
}

if($_SESSION['loggedIn'] == false) {
    CtlDisplayLoginPage();
} else {
    CtlDisplayPage();
}