

<form class="contract-list-form" id="contract-page" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedContract = null;

        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $contracts = getContractData($clientId);
            if (empty($contracts)) {
                echo '<p>Aucun contrat n\'est disponible pour ce client.</p>';
            } 
        else {
            echo '<div id="div-container">';
            foreach ($contracts as $contract) {
                $optionValue = $contract->NOMCONTRAT;
                echo '<div class="contract-div">';
                echo '<div class="information-div">';
                echo '<p>Type de contrat:' . $optionValue . '</p>';
                echo '<p>Date d\'ouverture:' . $contract->DATEOUVERTURECONTRAT . '</p>';

                echo '<button class="button" type="button"style="margin-left:30%;" onclick="switchForms(\'' . $optionValue . '\', \'' . $contract->DATEOUVERTURECONTRAT . '\', \'' . ($contract->DATEFERMETURE ? $contract->DATEFERMETURE : 'Indéterminée') . '\', \'' . $contract->TARIFMENSUEL . '\')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Voir details
                </button>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</form>

<form class="contract-details-page" id="contract-page" style="display: none;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedContract = null;
        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $contracts = getContractData($clientId);
    ?>
    <div name="contract-list"id="contract-list">
        <h5>Informations des contrats:</h5>
        <p>
            <label for="selected-contract-text">Type du contrat:</label>
            <input type="text" id="selected-contract-text" name="selected-contract-text" readonly>
            <input type="hidden" id="selected-contract" name="selected-contract">
        </p>

        <p>
            <label for="openning-date">Date d'ouverture:</label>
            <input id="openning-date" name="openning-date" type="text" value="<?php echo isset($selectedContract) ? $selectedContract->DATEOUVERTURECONTRAT : ''; ?>" readonly>
        </p>

        <p>
            <label for="closing-date">Date de fermeture:</label>
            <input id="closing-date" name="closing-date" type="text" value="" readonly>
        </p>

        <p>
            <label for="price">Tarif mensuel:</label>
            <input id="price" name="price" type="text" value="<?php echo isset($selectedContract) ? $selectedContract->TARIFMENSUEL : ''; ?>" readonly>
        </p>

        <input type="hidden" name="client-id" value="<?php echo $clientId; ?>">
        <input type="hidden" name="chosen-contract" id="chosen-contract" value="">

    </div>

    <?php }} ?>
</form>

<script>
    function switchForms(selectedContract, openingDate, closingDate, price) {
        document.getElementById('selected-contract-text').value = selectedContract;
        document.getElementById('openning-date').value = openingDate;
        document.getElementById('closing-date').value = closingDate;
        document.getElementById('price').value = price;
        document.getElementById('selected-contract').value = selectedContract;

        var form1 = document.querySelector('.contract-list-form');
        var form2 = document.querySelector('.contract-details-page');
        form1.style.display = 'none';
        form2.style.display = 'block';
    }
</script>