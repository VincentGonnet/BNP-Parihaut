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
                <select name="account-overdraft" id="account-overdraft">
    <?php if(isset($_SESSION['client-accounts'])) : ?>
        <?php foreach($_SESSION['client-accounts'] as $line) : ?>
            <?php if($line->MONTANTDECOUVERT === '-1.00'): ?>
                <option disabled value="<?php echo $line->NOMCOMPTE ?>"><?php echo $line->NOMCOMPTE ?></option>
            <?php else: ?>
                <option  value="<?php echo $line->NOMCOMPTE ?>"><?php echo $line->NOMCOMPTE ?></option>
            <?php endif; ?>
        <?php endforeach ?>
    <?php endif ?>
</select>
                    <div class="horizontal">
                        <input type="number" name="new-overdraft" value="" >
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

                    <?php if(isset($_SESSION['required-docs'])) : ?>
                        <input type="text" name="new-account-overdraft" value=<?php echo $_SESSION['required-docs']->LIBELLEMOTIF ?> readonly />
                    <?php endif ?>

                    <select name="new-account-overdraft" id="new-account-overdraft" onChange="saveSelectedAccountType()">
                        <option selected disabled>Selectionnez un compte</option>
                        <?php foreach(getAllAccounts() as $line) : ?>
                            <option value="<?php echo $line->NOMCOMPTE ?>" id="selected-account-<?php echo $line->AVOIRDECOUVERT ?>"><?php echo $line->NOMCOMPTE ?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="hidden" name="selected-account-type" id="selected-account-type" value="">

                    <div class="horizontal">
                        <input  class="modifiable" id="new-overdraft" type="number" name="new-overdraft" value="" >
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
    var selectElement = document.getElementById('new-account-overdraft');
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedAccountId = selectedOption.id; 
    var avoirDecouvert = selectedAccountId.split('-')[2]; 
    var overdraft=document.getElementById('new-overdraft');

    document.getElementById('selected-account-type').value = avoirDecouvert;

    var modifiableFields = document.querySelectorAll('.modifiable');
    if (avoirDecouvert == '-1'|| avoirDecouvert == "") {
        modifiableFields.forEach(function(field) {
            field.style.display = 'none';
            overdraft.value=-1;
        });
    } else {
        modifiableFields.forEach(function(field) {
            field.style.display = 'block';

        });
    }

    console.log('AVOIRDECOUVERT:', avoirDecouvert);
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