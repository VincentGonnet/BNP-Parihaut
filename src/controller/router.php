<?php
function displayRoute($routeName) {
    $roleName = explode('-', $routeName)[0];
    $viewName = array_slice(explode('-', $routeName), 1);
    $viewName = implode('-', $viewName);

    display($roleName, "view/$roleName/$viewName.php", getRouteTitle($routeName));
}


// List all routes here
function getRouteTitle($routeName) {
    switch ($routeName) {
        case 'agent-search-client':
            return "Rechercher un client";
        case 'agent-client-overview':
            return "Synthèse client";
        case 'agent-client-accounts':
            return "Comptes";
        case 'agent-client-contracts':
            return "Contrats";
        case 'agent-client-appointments':
            return "Rendez-vous";
            
        case 'advisor-planning':
            return "Planning";
        case 'director-manage-employees':
            return "Gérer les employés";
        case 'director-manage-account-types':
            return "Gérer les comptes";
        default:
            return $routeName;
    }
}