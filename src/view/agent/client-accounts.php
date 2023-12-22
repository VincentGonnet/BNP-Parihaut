
<form id="account-page" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedAccount = null;
        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $accounts = getAccountData($clientId);
            ?>

    <div name="account-list">
        <h5>Informations des comptes:</h5>

        <p>
            <label>Compte:</label>
            <select id="account" name="chosen-account" onchange="updateBalance()">
                <?php
                    foreach ($accounts as $account) {
                        $optionValue = $account->NOMCOMPTE;
                        $isSelected = ($optionValue == @$_POST['chosen-account']) ? 'selected' : '';
                        echo '<option name="' . $optionValue . '" value="' . $optionValue . '" ' . $isSelected . '>' . $optionValue . '</option>';
                        }
                    echo '<option value="" selected disabled hidden>Sélectionnez un compte</option>';
                    ?>
            </select> 
        </p>

        <p >
            <label for="solde">Solde du compte:</label>
            <input class="solde-container" id="solde" type="text" name="solde" value="<?php echo isset($selectedAccount) ? $selectedAccount->SOLDE : ''; ?>" readonly>
        </p>

        <p>
            <label for="decouvert">Decouvert:</label>
            <input id="decouvert" type="text" name="decouvert" value="<?php echo isset($selectedAccount) ? $selectedAccount->MONTANTDECOUVERT : ''; ?>" readonly>
        </p>


        <input type="hidden" name="client-id" value="<?php echo $clientId; ?>">
        <input type="hidden" name="selected-account" id="selected-account" value="">



        <p>
           <button   type="button" value="Modifier" onClick= "modifyDecouvert()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Modifier
            </button>


            <button type="submit" name="submit-decouvert-changes">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Valider
            </button>
        </p>
    </div>



    <div>
        <h5>Veuillez choisir une opération avant de saisir le montant</h5>

        <p>
            <input type="radio" name="operation" id="credit" onclick="setMax('credit')">
            <label for="credit">Créditer</label>

            <input type="radio" name="operation" id="debit" onclick="setMax('debit')">
            <label for="debit">Débiter</label>
        </p>

            <p>
                <input id="ammount" type="number" name="ammount" min="0" max="" step="10" value="0"></p>
                <button type="submit" id="submit-operation" name="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Valider l'opération
                </button>
            
    </div>
    
    
</form>

<?php }?>


<script>
        
        function updateBalance() {
    var selectedAccountIndex = document.getElementById('account').selectedIndex;
    var soldeInput = document.getElementById('solde');
    var decouvertInput = document.getElementById('decouvert');
    var selectedAccount = <?php echo json_encode($accounts); ?>[selectedAccountIndex];

    document.getElementById('selected-account').value = selectedAccount;
    soldeInput.value = selectedAccount.SOLDE;
    decouvertInput.value = selectedAccount.MONTANTDECOUVERT;

    // Mettez à jour la classe en fonction du solde
    if (selectedAccount.SOLDE > 0) {
        soldeInput.classList.remove('negative-balance');
        soldeInput.classList.add('positive-balance');
    } else {
        soldeInput.classList.remove('positive-balance');
        soldeInput.classList.add('negative-balance');
    }
}


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

    function modifyDecouvert(){
        var decouvert=document.getElementById('decouvert');
        decouvert.readOnly=false;
        }

</script>