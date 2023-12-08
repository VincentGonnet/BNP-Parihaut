<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BNP Parihaut - Login</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="style.css">
    </head>

    <div class="logo">
            <img src="bnp_parihaut.jpg" alt="bnplogo" />
    </div>

    
    <body id="loginBody">
        <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="center"><h2>&nbsp;Bienvenue sur BNP Parihaut&nbsp;</h2></div>
            <fieldset>
                <p><label>Votre identifiant  </label></p>
                <div class="inputBox"><input type="text" name="login" required><i class='bx bxs-user'></i></div><br>
                <p><label>Votre mot de passe  </label></p>
                <div class="inputBox"><input type="password" name="password" required><i class='bx bxs-lock-alt'></i></div>
                <p><label class="label_nostyle">&nbsp;</label><div class="center"><input type="submit" value="Se connecter" name="connection" /></div></p>
            </fieldset>
        </form>
        
</body>

</html>