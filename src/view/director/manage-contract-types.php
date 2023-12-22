<div id="allContracts">
    <div class="showContracts">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <tr>
                    <th>
                        Type de contrat
                    </th>

                    
                    <th></th>
                </tr>
                <?php if( isset($_SESSION['showAllContracts'])): ?>
                    <?php foreach($_SESSION['showAllContracts'] as $line): ?>
                        <tr>
                            <td>
                                <div class="contract">
                                <?php echo $line->NOMCONTRAT; ?>
                                </div>
                            </td>
                            
                            <td>
                                <input type="radio" name="radio-contract" value=<?php echo $line->NOMCONTRAT; ?> >
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </table>
        </div>
    
        <div class="edit-contracts">
            <input type="text" name="contract" onkeyup="this.value=this.value.toUpperCase()"/>
            <div class="space"></div>
            <button name="add-contract" value="add-contract">
                Ajouter un contrat
            </button>
            <div class="space"></div>
            
            <button name="delete-contract" value="delete-contract">
                Supprimer un contrat
            </button>
            <div class="space"></div>
            <button  name="delete-all-contracts" value="delete-all-contracts">
                Tout supprimer
            </button>
            
        </div>
    </form>

</div>