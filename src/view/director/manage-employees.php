<div id="manage-employees">
    <input type="text" onkeyup="liveSearch(this.value)" placeholder="NOM Prénom">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table class="employee-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Poste</th>
                    <th></th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody id="all-employes-body">
                <?php foreach (getAllEmployees() as $employee) {
                    require 'view/components/employee-table-row.php';
                }?>
            </tbody>
            <tbody id="live-search-results-employees">

            </tbody>
        </table>
    </form>
</div>

<script>
    const inputField = document.querySelector('#manage-employees input');
    const allEmployeesBody = document.querySelector('#all-employes-body');
    const liveSearchResults = document.querySelector('#live-search-results-employees');

    // on load
    window.addEventListener('load', () => {
        liveSearchResults.style.display = 'none';
    });

    function liveSearch(input) {
        if (input.length < 1) {
            liveSearchResults.style.display = 'none';
            allEmployeesBody.style.display = 'contents';
            return;
        }

        liveSearchResults.style.display = 'contents';
        allEmployeesBody.style.display = 'none';

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                liveSearchResults.innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', `controller/live-employees.php?liveSearchEmployees=${input}`, true);
        xhr.send();
    }

</script>