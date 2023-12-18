<td class="calendar-event" rowspan="<?= $eventRowspan ?>">
    <button name="calendar-event" value="<?= $event->NUMRDV ?>" type="submit" <?= ($_SESSION['loggedInUser']->CATEGORIE="advisor" && $_SESSION['loggedInUser']->NUMEMPLOYE == $event->NUMEMPLOYE) ? "" : "disabled" ?>>
        <strong><?= getFormattedClientName(searchClientById($event->NUMCLIENT)) ?></strong>
        <br>
        <?= getReasonById($event->IDMOTIF)->LIBELLEMOTIF ?>
    </button>
</td>