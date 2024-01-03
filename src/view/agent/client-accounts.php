
<form class="account-list-form" id="account-page" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedAccount = null;
        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $accounts = getAccountData($clientId);
    ?>
    <div id="div-container">
    <?php
        foreach ($accounts as $account) {
            $optionValue = $account->NOMCOMPTE;
            echo '<div class="account-div">';
            echo '<div class="information-div">';
            echo '<p >Compte:' . $optionValue . '</p>';
            echo '<p >Solde:' . $account->SOLDE . '</p>';
            echo '<input type="button" value="Voir détails"  style="background-color: #e8d2d2;border-style: inset;" onclick="switchForms(\'' . $optionValue . '\', ' . $account->SOLDE . ', ' . $account->MONTANTDECOUVERT . ')">';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    </div>
</form>


<form class="account-details-page" id="account-page" style="display: none;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedAccount = null;
        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $accounts = getAccountData($clientId);
            ?>

    <div id="account-list" name="account-list">
        <h5>Informations des comptes:</h5>

        <p class="p">
            <label class="label">Compte:</label>
            <input class="input" type="text" id="selected-account-text" name="selected-account-text" readonly>
            <input type="hidden" id="selected-account" name="selected-account"> 
        
        </p>

        <p class="p">
            <label class="label" for="solde">Solde du compte:</label>
            <input class="input" id="solde" type="text" name="solde" value="<?php echo isset($selectedAccount) ? $selectedAccount->SOLDE : ''; ?>" readonly>
        </p>

        <p class="p">
            <label class="label" for="decouvert">Decouvert:</label>
            <input class="input" id="decouvert" type="text" name="decouvert" value="<?php echo isset($selectedAccount) ? $selectedAccount->MONTANTDECOUVERT : ''; ?>" readonly>
        </p>


        <input type="hidden" name="client-id" value="<?php echo $clientId; ?>">
        <input type="hidden" name="selected-account" id="selected-account" value="">
        <input type="hidden" name="chosen-account" id="chosen-account" value="">


    </div>



    <div>
        <h5>Veuillez choisir une opération avant de saisir le montant</h5>

        <p class="p">
            <input class="radio" type="radio" name="operation" id="credit" onclick="setMax('credit')">
            <label class="label" for="credit">Créditer</label>

            <input class="radio" type="radio" name="operation" id="debit" onclick="setMax('debit')">
            <label class="label" for="debit">Débiter</label>
        </p>

            <p class="p">
                <input class="input" id="ammount" type="number" name="ammount" min="0" max="" step="10" value="0"></p>
                <button class="button" type="submit" id="submit-operation" name="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Valider l'opération
                </button>
            
    </div>
    
    


<?php }?>

</form>
<script>
       


    function setMax(operation) {
        var ammountInput = document.getElementById('ammount');
        var selectedOperationInput = document.getElementById('submit-operation');

        if (operation === 'credit') {
            ammountInput.max = "999999.99";
            selectedOperationInput.name = 'submit-credit';
        } else if (operation === 'debit') {
            ammountInput.max = "500.00";
            selectedOperationInput.name = 'submit-debit';
        }
        alert('Veuiller verifier que vous avez bien choisi un compte et une somme avant de valider.');
    }





    
    function switchForms(selectedAccount, solde, decouvert) {
        document.getElementById('selected-account-text').value = selectedAccount;
        document.getElementById('solde').value = solde;
        document.getElementById('decouvert').value = decouvert;
        document.getElementById('chosen-account').value = selectedAccount;

        var form1 = document.querySelector('.account-list-form');
        var form2 = document.querySelector('.account-details-page');
        form1.style.display = 'none';
        form2.style.display = 'block';

        var soldeInput = document.getElementById('solde');
        soldeInput.style.color = solde >= 0 ? 'green':'red';
    }

</script>

