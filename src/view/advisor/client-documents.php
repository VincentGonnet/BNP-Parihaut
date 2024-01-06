<!-- This is an example. Both variables currentEvent (rdv) and currentClient should be available here -->
<div id="allDocuments">
    <div class="advisor-documents"  >
        <form id="documentsForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <?php if( isset($_SESSION['getDoc'])): ?>
                    <tr>
                        <th><?= $_SESSION['getDoc']->LIBELLEMOTIF ?></th>
                    </tr>
                    <?php foreach(explode(",", $_SESSION['getDoc']->LISTEPIECES) as $document): ?>
                        <tr>
                            <td>
                                <label for="<?php echo $document; ?>"><?php echo $document; ?></label>
                                <input type="checkbox" id="<?php echo $document; ?>" name="<?php echo $document; ?>" <?= (isset($_SESSION['allChecked']) && $_SESSION['allChecked'] == true) ? "checked" : "unchecked" ?> onclick="SaveCheckState()">
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    Aucun justificatifs requis.
                <?php endif ?>
            </table>
        </form>
    </div>
</div>

<script>
    function SaveCheckState(){
        var checkboxes = document.querySelectorAll('#allDocuments table input[type="checkbox"]');
        var fullchecked = true;
        checkboxes.forEach((checkbox) => {
            if (!checkbox.checked){
                fullchecked = false;
            }     
        });
        
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `controller/live-documents.php?checkboxesState=${fullchecked}`, true);
        xhr.withCredentials = true;
        xhr.send(null);
    }
</script>


    