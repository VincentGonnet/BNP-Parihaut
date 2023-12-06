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
    if(!isset($_SESSION['loggedInUser'])) {
        $_SESSION['loggedIn'] = false;
        displayLoginPage();
        return;
    }

    if(!isset($_SESSION['currentPage'])) {
        if($_SESSION['loggedInUser']->POSTE == 'agent') {
            $_SESSION['currentPage'] = 'agent-search-client';
        } else if($_SESSION['loggedInUser']->POSTE == 'conseiller') {
            $_SESSION['currentPage'] = 'conseiller-planning';
        } else if($_SESSION['loggedInUser']->POSTE == 'directeur') {
            $_SESSION['currentPage'] = 'directeur-manage-employees';
        }
    }

    switch($_SESSION['currentPage']) {
        case 'agent-search-client':
            display("", "view/agent/search-client.php", "Rechercher un client");
            break;
        case 'conseiller-planning':
            display("", "view/conseiller/planning.php", "Planning");
            break;
        case 'directeur-manage-employees':
            display("", "view/directeur/manage-employees.php", "Gérer les employés");
            break;
    }
}

function CtlGlobalLayout() {
    require_once 'view/global-layout.php';
}
