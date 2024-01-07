<div id="allDocuments">
    <div class="showDocuments"  >
        <form id="documentsForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <tr>
                    <th>
                        Compte / Contrat
                    </th>
                    <th>
                        Pièces à fournir
                    </th>
                </tr>
                <?php if( isset($_SESSION['showAllDocuments'])): ?>
                    <?php foreach($_SESSION['showAllDocuments'] as $line): ?>
                        <tr>
                            <td>
                                <div class="document" >
                                    <input type="text" name="input-doc" id="<?php echo $line->IDMOTIF; ?>" value="<?php echo $line->LIBELLEMOTIF; ?>" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="document" >
                                    <input type="text" name="input-list" id="<?php echo $line->IDMOTIF; ?>" value="<?php echo $line->LISTEPIECES; ?>" readonly onkeyup="this.value=this.value.toUpperCase()">
                                    <!-- <button name="delete-document" value="<?php echo $line->IDMOTIF; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(246, 67, 67, 1);transform: ;msFilter:;">
                                        <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z">
                                        </path>
                                    </svg> 
                                    </button> -->
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </table>
        </form>
    </div>
    
        <div class="edit-documents-list" >
            <div class="edit-list-buttons">
                <button name="add-document" value="add-document" onclick="openModal(); return false;">
                    Modifier les justificatifs
                </button>
            </div> 
        </div>

    <modal id="add-doc-modal">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Modifier les justificatifs</h1>
            <div class="spacer"></div>
        
            <div class="form-content">
                <div>
                    <div class="label-containers">
                        <p>Compte / Contrat</p>
                        <p>Pièces à fournir<br>(séparées par une virgule)</p>
                    </div>
                    <div class="inputs">
                        <select name="doc-name" id="new-doc" onchange="getDocument(this.value)" required>
                            <option value="" disabled selected>Choisir un motif</option>
                            <?php if( isset($_SESSION['showAllDocuments'])): ?>
                                <?php foreach($_SESSION['showAllDocuments'] as $line): ?>
                                    <option value="<?php echo $line->LIBELLEMOTIF; ?>"><?php echo $line->LIBELLEMOTIF; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <input type="text" name="new-list" id="new-list" style="width: 300px";>
                    </div>
                </div>
            </div>
            <div class="spacer"></div>
            <button type="submit" name="modify-document" id="modify-document">Valider</button>
        </form>
    </modal>
    
</div>



<script>
    let modal = document.getElementById('add-doc-modal');

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