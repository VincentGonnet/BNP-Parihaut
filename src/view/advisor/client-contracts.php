<form class="contract-list-form" id="contract-page" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedContract = null;

        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $contracts = getContractData($clientId);
    ?>
        <?php
            foreach ($contracts as $contract) {
                $optionValue = $contract->NOMCONTRAT;
                echo '<div id="div-container">';
                echo '<div class="contract-div">';
                echo '<div class="information-div">';
                echo '<p>Type de contrat:' . $optionValue . '</p>';
                echo '<p>Date d\'ouverture:' . $contract->DATEOUVERTURECONTRAT . '</p>';
                echo '<button type="button" onclick="switchForms(\'' . $optionValue . '\', \'' . $contract->DATEOUVERTURECONTRAT . '\', \'' . ($contract->DATEFERMETURE ? $contract->DATEFERMETURE : 'Indéterminée') . '\', \'' . $contract->TARIFMENSUEL . '\')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Voir détails
                        </button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        ?>
        
        <p>
        <button class="button" type="button" onclick="addNewContract()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Ajouter Contrat
        </button>
        </p>
    
</form>



<!--LE FORM 2 POUR AFFICHER LES DETAILS.On a plusieurs forms pour pouvoir changer le view facilement.--> 

<form class="contract-details-page" id="contract-page" style="display: none;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $selectedContract = null;
        if (isset($_SESSION['currentClient'])) { 
            $clientId = $_SESSION['currentClient']->NUMCLIENT;
            $contracts = getContractData($clientId);
    ?>
    <div name="contract-list" id="contract-list">
        <h5>Informations des contrats:</h5>
        <p >
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

        <button class="button" type="submit" name="delete-client-contract" onClick="confirmation()" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            Resilier le contrat
        </button>
    </div>
 </form>


<!--FORM3 pour les nouveaux contrats-->

<form class="new-contract-page " style="display: none;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div id="new-contract-section" >
        <?php
            $allContract=getAllContracts();
            ?>
        <h5>Veuillez remplir les champs suivants:</h5>
        <p>
            <label class="label" for="new-contract-type">Type du contrat:</label>
            <select id="new-contract-type" name="new-contract-type" style="width:45%;background:#e8d2d2;padding: 6px 1% 6px 1%;margin-top:2px;">
                <?php 
                    foreach ($allContract as $contractOption) {
                        $clientHasContract = false;
                        foreach ($contracts as $clientContract) {
                            if ($clientContract->NOMCONTRAT === $contractOption->NOMCONTRAT) {
                                $clientHasContract = true;
                                    break;
                                    }
                                }
                                if (!$clientHasContract) {
                ?>
                <option value="<?php echo $contractOption->NOMCONTRAT; ?>">
                <?php echo $contractOption->NOMCONTRAT; ?>
                </option>
                <?php 
                        }
                    }
                ?>
            </select>      
        </p>

        <p>
            <label class="label" for="new-opening-date">Date d'ouverture:</label>
            <input class="input" id="new-opening-date" placeHolder="aaaa-mm-jj" name="new-opening-date" value="" type="text" style="margin-top:2px;">
        </p>

        <p>
            <label  class="label" for="new-closing-date">Date de fermeture:</label>
            <input  class="input" id="new-closing-date" placeHolder="aaaa-mm-jj" name="new-ending-date" value=""  type="text" style="margin-top:2px;">
        </p>

        <p>
            <label  class="label" for="new-price">Tarifs mensuel:</label>
            <input  class="input" id="new-price" name="new-price" placeHolder="000.00" type="text" style="margin-top:2px;" required>
        </p>

        <button  class="button" type="submit" name="submit-new-contract">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            Valider
            </button>
            <?php } } ?>
    </div>
</form>       

    


<script>

    function addNewContract() {
        var form1 = document.querySelector('.contract-list-form');
        var form3 = document.querySelector('.new-contract-page');
        form1.style.display = 'none';
        form3.style.display = 'block';
    }

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

    var newOpeningDateInput = document.getElementById('new-opening-date');
    if (newOpeningDateInput.value==""){
        var currentDate = new Date().toISOString().split('T')[0];
        newOpeningDateInput.value = currentDate;
    }
    var newEndingDateInput = document.getElementById('new-ending-date');
    if (newEndingDateInput.value==""){
        newEndingDateInput.value = NULL;
    }
    function confirmation(){
        alert("Apres cette operation le contrat courant sera resilie.Voulez vous vraiment le supprimer?");
    }
</script>
