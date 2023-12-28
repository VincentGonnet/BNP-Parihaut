<div id="add-employe" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <th colspan="2">
                Ajouter un employé
            </th>
            <tr>
                <td>
                    Nom du nouvel employé : 
                    <div class="space"></div>
                    <input type="text" name="name" />
                </td>
            </tr>
            <tr>
                <td>
                    Prénom du nouvel employé : 
                    <div class="space"></div>
                    <input type="text" name="firstname" />
                </td>
            </tr>
            <tr>
                <td>
                    Poste du nouvel employé : 
                    <div class="space"></div>
                    <select name="job" id="job-select">
                        <option value="">
                            Veuillez choisir un poste 
                        </option>
                        <option value="director"> 
                            Directeur 
                        </option>
                        <option value="agent">
                            Agent 
                        </option>
                        <option value="advisor">
                            Conseiller 
                        </option>
                </td>
            </tr>
            <tr>
                <td>
                    Login du nouvel employé : 
                    <div class="space"></div>
                    <input type="text" name="login" />
                </td>
            </tr>
            <tr>
                <td>
                    Mot de passe du nouvel employé : 
                    <div class="space"></div>
                    <input type="text" name="password" />
                </td>  
            </tr>
        </table>
        <div class="buttons" >
            <button name="register-new-employee" >
                Enregistrer
            </button>
            <button name="clear-inputs" type="reset">
                Vider les champs
            </button>
        </div>
            
    </form>
</div>