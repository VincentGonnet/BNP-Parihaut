<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BNP Parihaut - Login</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="style/login-style.css">
    </head>
    
    <body id="loginBody">
        <div class="logo">
                <img src="assets/bnp_parihaut.jpg" alt="bnplogo" />
                <h1>BNP Parihaut</h1>
        </div>
        <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2>Bienvenue</h2>
            
            <label>Votre identifiant  </label>
            <div class="inputBox">
                <input type="text" name="login" required>
                <i class='bx bxs-user'></i>
            </div>

            <label>Votre mot de passe  </label>
            <div class="inputBox">
                <input type="password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="center">
                <input type="submit" value="Se connecter" name="connection" />
            </div>
        </form>    
    </body>
</html>