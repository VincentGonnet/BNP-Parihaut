<?php

function displayLoginPage(){
    //formulaire de login de base, affiché lorsque que l'on arrive sur le site
    $view ='<form id="loginForm" action="index.php" method="post">
            <fieldset>
            <legend>Connexion à votre compte</legend>
            <p><label>Votre login : </label><input type="text" name="login" /></p>
            <p><label>Votre mot de passe : </label><input type="text" name="password" /></p>
            <p><input type="submit" value="Se connecter" name="connection" /></p
            </fieldset></form>';
    echo $view;
    
}