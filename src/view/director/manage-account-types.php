<div id="allAccounts">
    <div class="showAccounts">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <tr>
                    <th>
                        Type de compte
                    </th>

                    
                    <th></th>
                </tr>
                <?php if( isset($_SESSION['showAllAccounts'])): ?>
                    <?php foreach($_SESSION['showAllAccounts'] as $line): ?>
                        <tr>
                            <td>
                                <div class="account">
                                <?php echo $line->NOMCOMPTE; ?>
                                </div>
                            </td>
                            
                            <td>
                                <input type="radio" name="radio-account" value=<?php echo $line->NOMCOMPTE; ?> >
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </table>
        </div>
    
        <div class="edit-accounts">
            <input type="text" name="account" onkeyup="this.value=this.value.toUpperCase()"/>
            <div class="space"></div>
            <button name="add-account" value="add-account">
                Ajouter un compte
            </button>
            <div class="space"></div>
            
            <button name="delete-account" value="delete-account">
                Supprimer un compte
            </button>
            <div class="space"></div>
            <button  name="delete-all-accounts" value="delete-all-accounts">
                Tout supprimer
            </button>
            
        </div>
    </form>

</div>