<div id="allAccounts">
    <div class="advisor-accounts">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <tr>
                    <th>
                        Comptes ouverts du client
                    </th>
                </tr>
                <?php if(isset($_SESSION['client-accounts'])) : ?>
                    <?php foreach($_SESSION['client-accounts'] as $line) : ?>
                        <tr>
                            <td>
                                <input type="text" name="input-account-name" value="<?php echo $line->NOMCOMPTE ?>" readonly >
                                <div class="date"> 
                                    <div class="space"></div>
                                    <input type="text"  value="Date d'ouverture : " readonly >
                                    <input type="text" name="input-date" value="<?php echo $line->DATEOUVERTURE ?>" readonly >
                                </div>
                                <div class="overdraft">
                                    <div class="space"></div>
                                    <input type="text" name="overdraft-title" value="Montant maximal du découvert :"  readonly >
                                    <input type="text" name="input-overdraft" value="<?php echo $line->MONTANTDECOUVERT ?>" readonly >
                                </div> 
                                <button name="edit-overdraft">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(246, 67, 67, 1);transform: ;msFilter:;">
                                        <path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z">
                                        </path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </form>
    </div>
</div>

<script>
    
</script>