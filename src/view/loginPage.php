<?php

function displayLoginPage(){
    //formulaire de login de base, affiché lorsque que l'on arrive sur le site
    $view ='<form id="loginForm" action="index.php" method="post">
            <fieldset>
            <legend>Connexion à votre compte</legend>
            <p><label>Votre login : </label><input type="text" name="login" /></p>
            <p><label>Votre mot de passe : </label><input type="text" name="password" /></p>
            </fieldset></form>';
    require_once 'view/global-layout.php';
    
}