<div id="search-client">
    <div class="search-clients-search-fields">
        <div class="spacer"></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="client-id">Numéro de client</label>
            <input type="text" inputmode="numeric" pattern="\d*" name="client-id" id="client-id" required>
            <button name="agent-search-client-by-id" value="agent-search-client"> 
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
                Rechercher un client
            </button>
        </form>
        <hr>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="client-id">Numéro de client</label>
            <input type="text" name="client-id" id="client-id" placeholder="Numéro de client" required>
            <button name="agent-search-client" value="agent-search-client"> 
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
                Rechercher un client
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
                        <th>Numéro de client</th>
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
                                <td><?php echo $client->NUMCLIENT; ?></td>
                                <td><?php echo $client->NOM; ?></td>
                                <td><?php echo $client->PRENOM; ?></td>
                                <td><?php echo $client->ADRESSE; ?></td>
                                <td>
                                    <button type="submit" name="search-client-select-client" value=<?php echo $client->NUMCLIENT?>>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M6 10a.75.75 0 01.75-.75h9.546l-1.048-.943a.75.75 0 111.004-1.114l2.5 2.25a.75.75 0 010 1.114l-2.5 2.25a.75.75 0 11-1.004-1.114l1.048-.943H6.75A.75.75 0 016 10z" clip-rule="evenodd" />
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