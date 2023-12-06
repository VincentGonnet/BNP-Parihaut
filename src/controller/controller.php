<?php
require_once 'view/view.php';
session_start();

require_once 'model/user.php';

// if not logged in in the session
if(!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}

function CtlLogin($username, $password) {
    $user = logIn($username, $password);
    // TODO: if user is null, display error message
}

function CtlDisplayLoginPage() {
    displayLoginPage();
}

function CtlDisplayPage() {

}

function CtlGlobalLayout() {
    require_once 'view/global-layout.php';
}
