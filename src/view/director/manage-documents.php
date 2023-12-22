<div id="allDocuments">
    <div class="showDocuments"  >
        <form id="documentsForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <tr>
                    <th>
                        Type de Motif
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
                                    <input type="text" name="input-doc" value="<?php echo $line->LIBELLEMOTIF; ?>" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="document" >
                                    <input type="text" name="input-list" id="<?php echo $line->IDMOTIF; ?>" value="<?php echo $line->LISTEPIECES; ?>" readonly onkeyup="this.value=this.value.toUpperCase()">
                                    <button name="edit-list" onclick="modify(event)" value="<?php echo $line->IDMOTIF; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(246, 67, 67, 1);transform: ;msFilter:;">
                                            <path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button name="delete-document" value="<?php echo $line->IDMOTIF; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(246, 67, 67, 1);transform: ;msFilter:;">
                                        <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z">
                                        </path>
                                    </svg>
                                    </button>
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
                <button name="add-document" value="add-document" >
                    Ajouter un motif
                </button>
                <div class="space"></div>
                <button name="edit-list" value="<?php echo $line->IDMOTIF; ?>">
                        Modifier
                </button>
                <div class="space"></div>
                <button name="valid-changes">
                    Valider le changement
                </button>
            </div> 
        </div>
    
</div>

<modal id="edit-doc-modal">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Modifier un motif</h1>
        <div class="spacer"></div>
        
        <div class="form-content">
            <label>