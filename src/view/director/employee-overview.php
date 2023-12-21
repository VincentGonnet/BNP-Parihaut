<?php if (!isset($_SESSION['employeeToManage'])) {
    $_SESSION['currentPage'] = 'director-manage-employees';
    header('Location: index.php');
} else {
    $employee = $_SESSION['employeeToManage'];
} ?>
<div id="employee-overview">
    <div class="content">
        <h1>Informations de connection</h1>
        <form class="login-infos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="login">Identifiant</label>
            <input type="text" name="login" id="login" value="<?php echo $employee->LOGIN; ?>" readonly required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" value="<?php echo $employee->MDP; ?>" readonly required>
            <button type="button" id="modify-login-infos" onclick="modifyLoginInfos()">
                Modifier
            </button>
            <button type="submit" id="save-login-infos" name="modify-login-infos" style="display: none;">
                Sauvegarder
            </button>
            <button type="button" id="cancel-login-infos" onclick="cancelLoginInfos()" style="display: none;">
                Annuler
            </button>
        </form>
        <h1>Informations générales</h1>
        <form class="general-infos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>Numéro de l'employé</p>
            <p><?= $employee->NUMEMPLOYE ?></p>
            <label for="job">Poste</label>
            <select name="job" id="job" disabled>
                <option value="agent" <?php if ($employee->CATEGORIE == 'agent') echo 'selected'; ?>>Agent</option>
                <option value="advisor" <?php if ($employee->CATEGORIE == 'advisor') echo 'selected'; ?>>Conseiller</option>
                <option value="director" <?php if ($employee->CATEGORIE == 'director') echo 'selected'; ?>>Directeur</option>
            </select>
            <button type="button" id="modify-general-infos" onclick="modifyGeneralInfos()">
                Modifier
            </button>
            <button type="submit" id="save-general-infos" name="modify-general-infos" style="display: none;">
                Sauvegarder
            </button>
            <button type="button" id="cancel-general-infos" onclick="cancelGeneralInfos()" style="display: none;">
                Annuler
            </button>
        </form>
    </div>
</div>

<script>
    const loginInfos = document.querySelector('.login-infos');
    const modifyLoginInfosBtn = document.querySelector('#modify-login-infos');
    const saveLoginInfosBtn = document.querySelector('#save-login-infos');
    const cancelLoginInfosBtn = document.querySelector('#cancel-login-infos');
    let previousLogin = '';
    let previousPassword = '';

    function modifyLoginInfos() {
        loginInfos.querySelectorAll('input').forEach(input => {
            input.removeAttribute('readonly');
        });
        modifyLoginInfosBtn.style.display = 'none';
        saveLoginInfosBtn.style.display = 'inline-block';
        cancelLoginInfosBtn.style.display = 'inline-block';

        previousLogin = loginInfos.querySelector('#login').value;
        previousPassword = loginInfos.querySelector('#password').value;

        loginInfos.querySelector('#login').focus();
        loginInfos.querySelector('#login').select();
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

        loginInfos.querySelector('#login').value = previousLogin;
        loginInfos.querySelector('#password').value = previousPassword;

        modifyLoginInfosBtn.style.display = 'inline-block';
        saveLoginInfosBtn.style.display = 'none';
        cancelLoginInfosBtn.style.display = 'none';
    }

    const generalInfos = document.querySelector('.general-infos');
    const modifyGeneralInfosBtn = document.querySelector('#modify-general-infos');
    const saveGeneralInfosBtn = document.querySelector('#save-general-infos');
    const cancelGeneralInfosBtn = document.querySelector('#cancel-general-infos');
    let previousJob = '';

    function modifyGeneralInfos() {
        generalInfos.querySelector('#job').removeAttribute('disabled');

        previousJob = generalInfos.querySelector('#job').value;
        modifyGeneralInfosBtn.style.display = 'none';
        saveGeneralInfosBtn.style.display = 'inline-block';
        cancelGeneralInfosBtn.style.display = 'inline-block';
    }

    function saveGeneralInfos() {
        generalInfos.querySelector('#job').setAttribute('disabled', '');
        modifyGeneralInfosBtn.style.display = 'inline-block';
        saveGeneralInfosBtn.style.display = 'none';
        cancelGeneralInfosBtn.style.display = 'none';
    }

    function cancelGeneralInfos() {
        generalInfos.querySelector('#job').value = previousJob;

        generalInfos.querySelector('#job').setAttribute('disabled', '');
        modifyGeneralInfosBtn.style.display = 'inline-block';
        saveGeneralInfosBtn.style.display = 'none';
        cancelGeneralInfosBtn.style.display = 'none';
    }
</script>