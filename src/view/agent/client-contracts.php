
<form id="contract-page" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $selectedContract = null;

    if (isset($_SESSION['currentClient'])) { 
        $clientId = $_SESSION['currentClient']->NUMCLIENT;
        $contracts = getContractData($clientId);
    ?>

    <div>
        <h4>Consultation des contrats</h4>
        <p>
            <label for="contract-name">Type du contrat:</label>
            <select id="contract-name" name="chosen-contract" onchange="updateContractInfo()">
                <?php
                    foreach ($contracts as $contract) {
                        $optionValue = $contract->NOMCONTRAT;
                        $isSelected = ($optionValue == @$_POST['chosen-contract']) ? 'selected' : '';
                        echo '<option value="' . $optionValue . '" ' . $isSelected . '>' . $optionValue . '</option>';
                        }
                    echo '<option value="" selected disabled hidden>Sélectionnez un compte</option>';
                    if (empty($contracts)) {
                        echo '<option value="" disabled>Aucun contrat disponible</option>';
                        }
                ?>
            </select>
        </p>

        <p>
            <label for="openning-date">Date d'ouverture:</label>
            <input id="openning-date" name="opennig-date" type="text" value="<?php echo isset($selectedContract) ? $selectedContract->DATEOUVERTURECONTRAT : ''; ?>" readonly>
        </p>

        <p>
            <label for="closing-date">Date de fermeture:</label>
            <input id="closing-date" name="closing-date" type="text" value="" readonly>
        </p>

        <p>
            <label for="price">Tarif mensuel:</label>
            <input id="price" name="price" type="text" value="<?php echo isset($selectedContract) ? $selectedContract->TARIFMENSUEL : ''; ?>" readonly>
        </p>

        <p>
            <label for="situation-contract">Situation du contrat:</label>
            <input id="situation-contract" name="situation-contract" type="text" value="" readonly>
        </p>

    </div>

    <?php } ?>
</form>
<script>
    function updateContractInfo() {
    var selectedContractName = document.getElementById('contract-name').value;
    var contracts = <?php echo json_encode($contracts); ?>;
    var selectedContract = contracts.find(contract => contract.NOMCONTRAT === selectedContractName);

    if (selectedContract) {
        document.getElementById('openning-date').value = selectedContract.DATEOUVERTURECONTRAT;
        var closingDateValue = selectedContract.DATEFERMETURE ? selectedContract.DATEFERMETURE : 'Inderteminee';
        document.getElementById('closing-date').value = closingDateValue;
        document.getElementById('price').value = selectedContract.TARIFMENSUEL;
    }
    var situation= document.getElementById('situation-contract');
    var currentDate = new Date();
        var closingDate = selectedContract.DATEFERMETURE ? new Date(selectedContract.DATEFERMETURE) : null;
        if (closingDate && closingDate < currentDate) {
            situation.value="Terminé";
        } else {
            situation.value="Courant";
        }
}
</script>
