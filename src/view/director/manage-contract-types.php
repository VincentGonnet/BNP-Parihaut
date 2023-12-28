<div id="allContracts">
    <div class="showContracts">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <tr>
                    <th>
                        Type de contrat
                    </th>

                    
                </tr>
                <?php if( isset($_SESSION['showAllContracts'])): ?>
                    <?php foreach($_SESSION['showAllContracts'] as $line): ?>
                        <tr>
                            <td>
                                <div class="contract">
                                    <input type="text" name="contract-name" value="<?php echo $line->NOMCONTRAT; ?>" readonly>
                                    <div class="buttons">
                                        <button name="delete-contract" value="<?php echo $line->NOMCONTRAT; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(246, 67, 67, 1);transform: ;msFilter:;">
                                                <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z">
                                                </path>
                                            </svg> 
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </table>
            <div class="edit-contracts">
                <button name="add-contract" value="add-contract" onclick="openModal(); return false;">
                    Ajouter un contrat
                </button>
            </div>
        </form>
    </div>
</div>

<modal id="add-contract-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Ajouter un type de contrat</h1>
        <div class="spacer"></div>
        <div class="form-content">
            <div>
                <div class="label-containers">
                    <p>Nom du contrat</p>
                </div>
                <div class="inputs">
                    <input type="text" name="new-contract" id="new-contract"  onkeyup="this.value=this.value.toUpperCase()" >   
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <button type="submit" name="add-contract" id="add-contract"  >Valider</button>
    </form>
</modal>





<script>
    let modal = document.getElementById('add-contract-modal');

    function openModal() {
        modal.style.opacity = 1;
        modal.style.pointerEvents = "auto";
    }

    function closeModal() {
        modal.style.opacity = 0;
        modal.style.pointerEvents = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }

</script>