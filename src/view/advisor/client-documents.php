<!-- This is an example. Both variables currentEvent (rdv) and currentClient should be available here -->
<div id="allDocuments">
    <div class="advisor-documents"  >
        <form id="documentsForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table> 
                <?php if( isset($_SESSION['getDoc'])): ?>
                    <?php foreach($_SESSION['getDoc'] as $line) : ?>
                        <input id="list-name" value="<?php echo $line->LISTEPIECES; ?>">
                        <tr>
                            <th>
                                <?php echo $line->LIBELLEMOTIF; ?>
                            </th>
                        </tr>
                      
                        <script>
                            var listInput = document.getElementById("list-name");
                            if (listInput){
                                var list = listInput.value;
                            }
                            const Array = list.split(",");

                            function Split(){
                            Array.forEach(function (line){
                                document.write(("<tr><td>") +  line  + ("<input type='checkbox' name='check-box' value="+ line +" >") + ("</td></tr>")  );
                            })}

                            window.onmouseover = Split();
                        </script>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </form>
    </div>
</div>


    