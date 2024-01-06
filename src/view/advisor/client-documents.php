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
                                var number =0;
                                Array.forEach(function (line){
                                    number +=1;
                                    document.write(("<tr><td>") +  line  + ("<input type='checkbox' name='check-box' id='checkbox-"+number+"' value="+ line +" >") + ("</td></tr>")  );
                            })}

                            window.onmouseover = Split();

                            function SaveCheckState(){
                                var checkboxes = document.querySelectorAll('table input[type="checkbox"]');
                                var fullchecked = true;
                                checkboxes.forEach((checkbox) => {
                                    localStorage.setItem(checkbox.id , checkbox.checked);
                                    if (!checkbox.checked){
                                        fullchecked = false;
                                    }     
                                });
                                
                                const xhr = new XMLHttpRequest();
                                xhr.open('GET', `controller/live-documents.php?checkboxesState=${fullchecked}`, true);
                                xhr.withCredentials = true;
                                xhr.send(null);
                            }


                            function LoadSaveCheckedState(){
                                var checkboxes = document.querySelectorAll('table input[type="checkbox"]');
                                checkboxes.forEach((checkbox) => {
                                    var isChecked = localStorage.getItem(checkbox.id) == 'true';
                                    checkbox.checked = isChecked;
                                });
                            }

                            window.addEventListener('load' , LoadSaveCheckedState);

                            document.addEventListener('change' , function(event){
                                if(event.target.type == 'checkbox'){
                                    SaveCheckState();
                                }
                            });

                                
                                
                            
                        </script>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </form>
    </div>
</div>


    