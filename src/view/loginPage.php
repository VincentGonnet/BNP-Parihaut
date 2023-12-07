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
                    <p><label>Votre login : </label></p>
                    <p><input type="text" name="login" /></p>
                    <p><label>Votre mot de passe : </label></p>
                    <p><input type="text" name="password" /></p>
                    <p><label class="label_nostyle">&nbsp;</label>
                    <p><input type="submit" value="Se connecter" name="connection" /></p>
            </fieldset>
        </form>
</body>

</html>