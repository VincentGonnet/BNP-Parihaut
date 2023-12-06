<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNP Parishaut - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>Connexion à votre compte</legend>
            <p><label>Votre identifiant : </label></p>
            <p><input type="text" name="username" /></p>
            <p><label>Votre mot de passe : </label></p>
            <p><input type="text" name="password" /></p>
            <p><input type="submit" value="Se connecter" name="login" /></p>
        </fieldset>
    </form>
</body>

</html>