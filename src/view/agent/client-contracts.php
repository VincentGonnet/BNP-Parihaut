

<form class="contract-list-form" id="contract-page" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedContract = null;

        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $contracts = getContractData($clientId);
    ?>
    <div id="div-container">
        <?php
            foreach ($contracts as $contract) {
                $optionValue = $contract->NOMCONTRAT;
                echo '<div class="contract-div" style="border: 2px solid var(--primary-color);border-radius: 10px;
                width: 65%;">';
                echo '<div class="information-div">';
                echo '<p>Type de contrat:' . $optionValue . '</p>';
                echo '<p>Date d\'ouverture:' . $contract->DATEOUVERTURECONTRAT . '</p>';
                echo '<input type="button" value="Voir détails" style="background-color: #e8d2d2;border-style: inset;" class="button" onclick="switchForms(\'' . $optionValue . '\', \'' . $contract->DATEOUVERTURECONTRAT . '\', \'' . ($contract->DATEFERMETURE ? $contract->DATEFERMETURE : 'Indéterminée') . '\', \'' . $contract->TARIFMENSUEL . '\')">';
                echo '</div>';
                echo '</div>';
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
    <div name="contract-list">
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
