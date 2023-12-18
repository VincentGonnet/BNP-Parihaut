<div id="allDocuments">
    <div class="showDocuments">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <tr>
                    <th>
                        Type de Motif
                    </th>
                    <th>
                        Pièces à fournir
                    </th>

                    
                    <th></th>
                </tr>
                <?php if( isset($_SESSION['showAllDocuments'])): ?>
                    <?php foreach($_SESSION['showAllDocuments'] as $line): ?>
                        <tr>
                            <td>
                                <div class="document">
                                    <?php echo $line->LIBELLEMOTIF; ?>
                                </div>
                            </td>
                            <td>
                                <div class="document">
                                    <?php echo $line->LISTEPIECES; ?>
                                </div>
                            </td>
                            <td>
                                <input type="radio" name="radio-document" value=<?php echo $line->IDMOTIF; ?> >
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </table>
        </div>
    
        <div class="edit-Documents">
            <input type="text" name="document" onkeyup="this.value=this.value.toUpperCase()"/>
            <div class="space"></div>
            <input type="text" name="list" onkeyup="this.value=this.value.toUpperCase()"/>
            <div class="space"></div>
            <button name="add-document" value="add-document">
                Ajouter un motif
            </button>
            <div class="space"></div>
            
            <button name="delete-document" value="delete-document">
                Supprimer un motif
            </button>
            <div class="space"></div>
            <button  name="delete-all-Documents" value="delete-all-Documents">
                Tout supprimer
            </button>
            
        </div>
    </form>

</div>