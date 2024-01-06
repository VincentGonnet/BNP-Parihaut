<?php
$user = $_SESSION['loggedInUser'];
?>

<div id="user-infos">
    <form class="login-infos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>Informations de connection</legend>
            <div>
                <label for="login">Identifiant</label>
                <p><?= $user->LOGIN ?></p>
                
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" value="<?php echo $user->MDP; ?>" readonly required>
            </div>
            
        </fieldset>          
        <button class="red-button" type="button" id="modify-login-infos" onclick="modifyLoginInfos()">
            Modifier
        </button>
        <button class="red-button" type="submit" id="save-login-infos" name="modify-my-infos" style="display: none;">
            Sauvegarder
        </button>
        <button class="red-button" type="button" id="cancel-login-infos" onclick="cancelLoginInfos()" style="display: none;">
            Annuler
        </button>
    </form>
</div>

<script>
    const loginInfos = document.querySelector('.login-infos');
    const modifyLoginInfosBtn = document.querySelector('#modify-login-infos');
    const saveLoginInfosBtn = document.querySelector('#save-login-infos');
    const cancelLoginInfosBtn = document.querySelector('#cancel-login-infos');
    let previousPassword = '';

    function modifyLoginInfos() {
        loginInfos.querySelectorAll('input').forEach(input => {
            input.removeAttribute('readonly');
        });
        modifyLoginInfosBtn.style.display = 'none';
        saveLoginInfosBtn.style.display = 'inline-block';
        cancelLoginInfosBtn.style.display = 'inline-block';

        previousPassword = loginInfos.querySelector('#password').value;

        loginInfos.querySelector('#password').focus();
        loginInfos.querySelector('#password').select();
        loginInfos.querySelector('#password').value = null;
    }

    function saveLoginInfos() {
        loginInfos.querySelectorAll('input').forEach(input => {
            input.setAttribute('readonly', '');
        });
        modifyLoginInfosBtn.style.display = 'inline-block';
        saveLoginInfosBtn.style.display = 'none';
        cancelLoginInfosBtn.style.display = 'none';
    }

    function cancelLoginInfos() {
        loginInfos.querySelectorAll('input').forEach(input => {
            input.setAttribute('readonly', '');
        });

        loginInfos.querySelector('#password').value = previousPassword;

        modifyLoginInfosBtn.style.display = 'inline-block';
        saveLoginInfosBtn.style.display = 'none';
        cancelLoginInfosBtn.style.display = 'none';
    }
</script>