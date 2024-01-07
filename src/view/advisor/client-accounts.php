<div id="allAccounts">
    <div class="advisor-accounts">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
            $appointmentConcernsAccount = false;
            foreach (getAllAccounts() as $account) {
                if($account->NOMCOMPTE == $_SESSION['required-docs']->LIBELLEMOTIF) {
                    $appointmentConcernsAccount = true;
                }
            }

            $allChecked = isset($_SESSION['allChecked']) && $_SESSION['allChecked'] == true;
        ?>

        <?php if(!$appointmentConcernsAccount) : ?>
            <h4>Attention le rendez-vous ne concerne pas de compte. Certaines actions sont par conséquent bloquées.</h4>
        <?php elseif (!$allChecked): ?>
                <h4>Attention vous ne possédez pas toutes les pièces justificatives requises. Certaines actions sont par conséquent bloquées.</h4>
        <?php endif; ?>
                
            <table> 
                <tr>
                    <th>
                        Comptes ouverts du client
                    </th>
                </tr>
                <?php if(isset($_SESSION['client-accounts'])) : ?>
                    <?php foreach($_SESSION['client-accounts'] as $line) : ?>
                        <tr>
                            <td>
                                <input type="text" name="input-account-name" value="<?php echo $line->NOMCOMPTE ?>" readonly >
                                <div class="date"> 
                                    <div class="space"></div>
                                    <input type="text"  value="Date d'ouverture : " readonly >
                                    <input type="text" name="input-date" value="<?php echo $line->DATEOUVERTURE ?>" readonly >
                                </div>
                                <div class="overdraft">
                                    <div class="space"></div>
                                    <input type="text" name="overdraft-title" value="Montant maximal du découvert :"  readonly >
                                    <input type="text" name="input-overdraft" value="<?php echo $line->MONTANTDECOUVERT ?>" readonly >
                                </div> 
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
            <div class="buttons">
                <button name="edit-overdraft"  onclick="openOverdraftModal(); return false;">
                    Modifier le découvert d'un compte
                </button>
                <div class="space"></div>
                <button name="new-account"  id ="add-delete" onclick="openAccountModal(); return false;">
                    Ouvrir un nouveau compte
                </button>
                <div class="space"></div>
                <button name="delete-client-account" id ="add-delete" onclick="openDeleteModal(); return false;">
                    Fermer un compte 
                </button>
            </div>
        </form>
    </div>
</div>

<modal id="edit-overdraft-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Modifier le montant de découvert</h1>
        <div class="spacer"></div>
        <div class="form-content">
            <div>
                <div class="label-containers">
                    <p>Nom du compte : </p>
                    <p>Nouveau montant : </p>
                </div>
                <div class="inputs">
                <?php
                    if(isset($_SESSION['client-accounts'])) {
                        $clientAccounts = $_SESSION['client-accounts'];
                        $overdraftAccounts = array();
                        foreach($clientAccounts as $account) {
                            if (getAccountbyName($account->NOMCOMPTE)->AVOIRDECOUVERT != '-1.00' && getAccountbyName($account->NOMCOMPTE)->AVOIRDECOUVERT != '') {
                                array_push($overdraftAccounts, $account);
                            }
                        }
                    }
                ?>
                <select name="account-overdraft" id="account-overdraft">
                    <?php if(isset($_SESSION['client-accounts'])) : ?>
                        <?php foreach($overdraftAccounts as $line) : ?>
                            <option  value="<?php echo $line->NOMCOMPTE ?>"><?php echo $line->NOMCOMPTE ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
                    <div class="horizontal">
                        <input type="number" name="new-overdraft" value="" min="0" required >
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <button type="submit" name="accept-overdraft" id="accept-overdraft"  >Valider</button>
    </form>
</modal>


<modal id="add-account-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Ouvrir un nouveau compte</h1>
        <div class="spacer"></div>
        <div class="form-content">
            <div>
                <div class="label-containers">
                    <p>Nom du compte : </p>
                    <p class="modifiable" >Montant du découvert : </p>
                </div>
                <div class="inputs">
                    <select name="new-account-name" id="new-account-name" onChange="saveSelectedAccountType()">
                        <option selected disabled>Selectionnez un compte</option>
                        <?php foreach(getAllAccounts() as $line) : ?>
                            <option value="<?php echo $line->NOMCOMPTE ?>" id="selected-account,<?php echo $line->AVOIRDECOUVERT ?>"><?php echo $line->NOMCOMPTE ?></option>
                        <?php endforeach ?>
                    </select>

                    <div class="horizontal">
                        <input class="modifiable" id="new-overdraft" type="number" name="new-overdraft" value="0" min="0" >
                        <p id="no-overdraft" style="display: none; font-size: small;">Aucun découvert possible</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <button type="submit" name="accept-account" id="accept-account"  >Valider</button>
    </form>
</modal>


<modal id="delete-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Supprimer un compte</h1>
        <div class="spacer"></div>
        <div class="form-content">
            <div>
                <div class="label-containers">
                    <p>Nom du compte : </p>
                </div>
                <div class="inputs">
                        <?php if(isset($_SESSION['required-docs'])) : ?>
                            <input type="text" name="account-to-delete" value=<?php echo $_SESSION['required-docs']->LIBELLEMOTIF ?> readonly />
                        <?php endif ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <button type="submit" name="accept-delete-account" id="accept-delete-account"  >Fermer le compte</button>
    </form>
</modal>



<script>
    let overdraftModal = document.getElementById('edit-overdraft-modal');
    let accountModal = document.getElementById('add-account-modal');
    let deleteModal = document.getElementById('delete-modal');
    function openOverdraftModal() {
        overdraftModal.style.opacity = 1;
        overdraftModal.style.pointerEvents = "auto";
    }

    function openAccountModal(){
        accountModal.style.opacity = 1;
        accountModal.style.pointerEvents = "auto";
    }

    function openDeleteModal(){
        deleteModal.style.opacity = 1;
        deleteModal.style.pointerEvents = "auto";
    }

    function closeDeleteModal(){
        deleteModal.style.opacity = 0;
        deleteModal.style.pointerEvents = "none";
    }

    function closeOverdraftModal() {
        overdraftModal.style.opacity = 0;
        overdraftModal.style.pointerEvents = "none";
    }

    function closeAccountModal() {
        accountModal.style.opacity = 0;
        accountModal.style.pointerEvents = "none";
    }

    function saveSelectedAccountType() {
        var selectElement = document.getElementById('new-account-name');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedAccountId = selectedOption.id; 
        var avoirDecouvert = selectedAccountId.split(',')[1]; 
        var overdraft=document.getElementById('new-overdraft');


        var modifiableFields = document.querySelectorAll('.modifiable');
        if (avoirDecouvert == '-1'|| avoirDecouvert == "") {
            document.getElementById('no-overdraft').style.display = "block";
            document.getElementById('new-overdraft').style.display = "none";
        } else {
            document.getElementById('no-overdraft').style.display = "none";
            document.getElementById('new-overdraft').style.display = "block";
        }
    }

    window.onclick = function(event) {
        if (event.target == overdraftModal) {
            closeOverdraftModal();
        } else if (event.target == accountModal) {
            closeAccountModal();
        } else if (event.target == deleteModal) {
            closeDeleteModal();
        }
    }

</script>

<?php if(!$allChecked || !$appointmentConcernsAccount) : ?>
    <script>
        var buttons = document.querySelectorAll("#add-delete");
        buttons.forEach(function(button){
            button.style.backgroundColor = 'grey';
            button.onclick = null;
        })
    </script>
<?php endif; ?>