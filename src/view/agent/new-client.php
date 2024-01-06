<div id="add-new-client">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>Identité</legend>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" required>
    
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" required>

            <label for="birthday">Date de naissance</label>
            <input type="date" name="birthday" id="birthday" required>
        </fieldset>

        <fieldset>
            <legend>Contact</legend>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Téléphone</label>
            <input type="tel" name="phone" id="phone" required>
        </fieldset>

        <fieldset>
            <legend>Adresse</legend>

            <label for="street">Rue</label>
            <input type="text" name="street" id="street" required>

            <label for="city">Ville</label>
            <input type="text" name="city" id="city" required>

            <label for="zip">Code postal</label>
            <input type="number" name="zip" id="zip" required value="90000" min="0" max="99990" step="10" onchange="checkZipCode()">

            <label for="country">Pays</label>
            <select name="country" id="country">
                <option value="France" selected>France</option>
                <option value="Royaume-Uni">Royaume-Uni</option>
                <option value="Allemagne">Allemagne</option>
                <option value="Espagne">Espagne</option>
                <option value="Italie">Italie</option>
                <option value="Pologne">Pologne</option>
                <option value="Suède">Suède</option>
                <option value="Danemark">Danemark</option>
                <option value="Finlande">Finlande</option>
                <option value="Norvège">Norvège</option>
                <option value="Islande">Islande</option>
                <option value="Suisse">Suisse</option>
                <option value="Autriche">Autriche</option>
                <option value="Belgique">Belgique</option>
                <option value="Pays-Bas">Pays-Bas</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Portugal">Portugal</option>
            </select>
        </fieldset>

        <fieldset>
            <legend>Situation</legend>

            <label for="situation">Familiale</label>
            <select name="situation" id="situation">
                <option value="Célibataire" selected>Célibataire</option>
                <option value="Marié(e)">Marié(e)</option>
                <option value="Divorcé(e)">Divorcé(e)</option>
                <option value="Veuf(ve)">Veuf(ve)</option>
            </select>

            <label for="work">Profession</label>
            <input type="text" name="work" id="work" required>
        </fieldset>

        <fieldset>
            <legend>Conseiller</legend>

            <label for="advisor">Conseiller</label>
            <select name="advisor" id="advisor" required>
                <option value="" disabled selected>Choisir un conseiller</option>
                <?php foreach (getAllAdvisors() as $advisor): ?>
                    <option value="<?= $advisor->NUMEMPLOYE ?>"><?= $advisor->PRENOM. " " .strtoupper($advisor->NOM) ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>

        <input type="submit" name="add-new-client" value="Ajouter">
    </form>
</div>