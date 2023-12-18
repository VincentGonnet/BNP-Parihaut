

<form id="overview"   action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php


   if(isset($_SESSION['currentClient'])){  
        $employeId = $_SESSION['currentClient']->NUMEMPLOYE;
        $employe = getEmployeeById($employeId);
        $name = $_SESSION['currentClient']->NOM;
        $firstName = $_SESSION['currentClient']->PRENOM;
        $clientId = $_SESSION['currentClient']->NUMCLIENT;
        $adress = $_SESSION['currentClient']->ADRESSE;
        $birthday = $_SESSION['currentClient']->DATENAISSANCE;
        $mail = $_SESSION['currentClient']->MAIL;
        $phoneNumber = $_SESSION['currentClient']->NUMTEL ;
        $situation = $_SESSION['currentClient']->SITUATION ;
        $work = $_SESSION['currentClient']->PROFESSION;
        $checked = $_SESSION['currentClient']->ENREGISTRE ;
        $advisorId = $_SESSION['currentClient']->NUMEMPLOYE;

    ?>  

   
    <div>

        <p>
            <label  id="name">Nom:</label>
            <input name="input-name" for="idClient" type="text" value="<?= $name ?>" readOnly>
        </p>


        <p>
            <label id="firstName">Prenom:</label>
            <input  name="input-first-name" for="firstName" type="text" value="<?= $firstName ?>" readOnly>
        </p>


        <p>
            <label id="birthday"> Date de naissance:</label>
            <input name="input-birthday"  for="birthday" type="text" value="<?= $birthday ?>" readOnly>
        </p>

        <p>
            <label id="adress"> Adresse:</label>
            <input  name="input-adress" for="adress" type="text" value="<?= $adress ?>" readOnly>
        </p>


        <p>
            <label id="clientId">Numero client:</label>
            <input name="input-client-id"  for="checked" type="text" value="<?= $clientId ?>" readOnly>
        </p>
    </div>

    <div>
        <p> 
            <label id="mail"> Mail:</label>
            <input  name="input-mail" for="mail" type="text" value="<?= $mail ?>" readOnly>
        </p> 

        <p>
            <label id="phone">Numéro de telephone:</label>
            <input name="input-phone-number"  for="phone" type="text" value="<?= $phoneNumber?>" readOnly>
        </p>

        <p>
            <label id="situation">Situation familiale:</label>
            <input name="input-situation"  for="situation" type="text" value="<?= $situation?>" readOnly>
        </p>


        <p>
            <label id="work">Profession:</label>
            <input name="input-work" for="work" type="text" value="<?= $work ?>" readOnly>
        </p>

    
    
        <p>
            <label id="checked">Enregistre:</label>
            <input name="input-checked"  for="checked" type="text" value="<?= $checked?>" readOnly>
        </p>
</div>

<div>
    <h3>Conseiller reponsable</h3>
        
    <p>
        <label id="advisor">Id conseiller:</label>
        <input name="input-advisor-id" for="advisor" type="text" value="<?= $advisorId ?>" readOnly>
    </p>

    <p>
        <label id="advisorName">Nom:</label>
        <input name="input-advisor-name" for="AdvisorName" type="text" value="<?= $employe->NOM ?>" readOnly>
    </p>

    <p>
        <label id="advisorFirstName">Prenom:</label>
        <input name="input-advisor-first-name" for="employeFirstName" type="text" value="<?= $employe->PRENOM ?>" readOnly>
    </p>

    </div>

    <div>
    <button   type="button" value="Modifier" onClick= "modifier()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>

        Modifier
        </button>

        <button type="submit" name="submit-overview-changes">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
         <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>

        Valider
        </button>
    </div>

    <?php  } ?>
    
    <script>
        
        var inputs = document.querySelectorAll('#overview input[type="text"]');
        function modifier(){
            inputs.forEach(function(input) {
            input.readOnly = false;
            });
            
        }
                    
        
        
        
    
    </script>


</form>
