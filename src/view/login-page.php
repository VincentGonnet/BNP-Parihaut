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
                <input type="text" name="login" id="login" required>
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

        <!-- Helper to get password and logins -->
        <aside>
            <button>❌</button>
            <h2>Mot de passe pour tous les comptes</h2>
            <p>➡️ <code>password</code></p>
            <h2>Identifiants agents</h2>
            <?php foreach (getAllAgents() as $agent): ?>
                <p>➡️ <code><?php echo $agent->LOGIN; ?></code></p>
            <?php endforeach ?>
            <h2>Identifiants conseillers</h2>
            <?php foreach (getAllAdvisors() as $advisor): ?>
                <p>➡️ <code><?php echo $advisor->LOGIN; ?></code></p>
            <?php endforeach ?>
            <h2>Identifiants directeurs</h2>
            <?php foreach (getAllDirectors() as $director): ?>
                <p>➡️ <code><?php echo $director->LOGIN; ?></code></p>
            <?php endforeach ?>
        </aside>
    </body>
</html>

<script>
    const aside = document.querySelector('aside');
    const button = document.querySelector('aside button');

    button.addEventListener('click', () => {
        aside.classList.toggle('active');
    });

    const loginInput = document.querySelector('#login');
    
    loginInput.addEventListener('input', () => {
        if (loginInput.value.toLowerCase() === 'help') {
            aside.classList.toggle('active');
            setTimeout(() => {
                loginInput.value = '';
            }, 2000);
        }
    });
</script>