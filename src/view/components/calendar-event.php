<td class="calendar-event" rowspan="<?= $eventColspan ?>">
    <button name="calendar-event" value="<?= $event->NUMRDV ?>" type="submit">
        <strong><?= getFormattedClientName(searchClientById($event->NUMCLIENT)) ?></strong>
        <br>
        <?= getReasonById($event->IDMOTIF)->LIBELLEMOTIF ?>
    </button>
</td>