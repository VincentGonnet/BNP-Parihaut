<td class="calendar-event" rowspan="<?= $eventColspan ?>">
    <?= getFormattedClientName(searchClientById($event->NUMCLIENT)) ?>
    <br>
    <?= getReasonById($event->IDMOTIF)->LIBELLEMOTIF ?>
</td>