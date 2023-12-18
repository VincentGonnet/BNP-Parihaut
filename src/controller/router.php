<?php
function displayRoute($routeName) {
    $roleName = explode('-', $routeName)[0];
    $viewName = array_slice(explode('-', $routeName), 1);
    $viewName = implode('-', $viewName);

    display($roleName, "view/$roleName/$viewName.php", getRouteTitle($routeName), getRouteAdditionalTitle($routeName));
}


// List all routes here
function getRouteTitle($routeName) {
    switch($routeName) {
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
        case 'advisor-client-documents':
            return "Justificatifs";
        case 'advisor-client-overview':
            return "Synthèse client";
        case 'advisor-client-accounts':
            return "Comptes";
        case 'advisor-client-contracts':
            return "Contrats";
        case 'advisor-client-appointments':
            return "Rendez-vous";

        case 'director-manage-employees':
            return "Gérer les employés";
        case 'director-add-employee':
            return "Ajouter un employé";
        case 'director-manage-account-types':
            return "Gérer les types de comptes";
        case 'director-manage-contract-types':
            return "Gérer les types de contrats";
        case 'director-see-stats':
            return "Statistiques";
        case 'director-manage-documents';
            return "Pièces justificatives";
        default:
            return $routeName;
    }
}

function getRouteAdditionalTitle() {
    if(isset($_SESSION['currentClient'])) {
        return $_SESSION['currentClient']->PRENOM.' '.strtoupper($_SESSION['currentClient']->NOM).' #'.$_SESSION['currentClient']->NUMCLIENT;
    } else {
        return null;
    }
}