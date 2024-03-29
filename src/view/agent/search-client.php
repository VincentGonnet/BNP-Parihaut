<div id="search-client">
    <div class="search-clients-search-fields">
        <div class="spacer"></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h3>Rechercher par ID</h3>

            <div class="spacer"></div>

            <div class="fields">
                <label for="client-id">Numéro du client</label>
                <input type="text" inputmode="numeric" pattern="\d*" name="client-id" id="client-id" required>
            </div>

            <div class="spacer"></div>

            <button name="agent-search-client-by-id" value="agent-search-client-by-id">
                Rechercher
            </button>
        </form>
        <hr>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h3>Rechercher par nom</h3>

            <div class="spacer"></div>

            <div class="fields">

                <label for="client-name">Nom</label>
                <input type="text" name="client-name" id="client-name" required>
                <label for="client-firstname">Prénom</label>
                <input type="text" name="client-firstname" id="client-firstname" required>
                
            </div>

            <div class="spacer"></div>

            <button name="agent-search-client-by-name" value="agent-search-client-by-name">
                Rechercher
            </button>
        </form>
        <div class="spacer"></div>
    </div>
    <hr>
    <div class="search-clients-results">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($_SESSION['searchClientResults'])): ?>
                        <?php foreach($_SESSION['searchClientResults'] as $client): ?>
                            <tr>
                                <td>
                                    <?php echo $client->NUMCLIENT; ?>
                                </td>
                                <td>
                                    <?php echo $client->NOM; ?>
                                </td>
                                <td>
                                    <?php echo $client->PRENOM; ?>
                                </td>
                                <td>
                                    <?php echo $client->ADRESSE; ?>
                                </td>
                                <td>
                                    <button type="submit" name="search-client-select-client" value=<?php echo $client->NUMCLIENT ?>>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M6 10a.75.75 0 01.75-.75h9.546l-1.048-.943a.75.75 0 111.004-1.114l2.5 2.25a.75.75 0 010 1.114l-2.5 2.25a.75.75 0 11-1.004-1.114l1.048-.943H6.75A.75.75 0 016 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </div>
</div>