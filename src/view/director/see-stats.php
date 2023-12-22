<div id="stats">
    <div class="cell">
        <div class="header">
            <input type="date" id="stats-start-contracts" value="<?= date('Y-m-d', strtotime('-1 month')) ?>" onchange="changeContracts()">
            <p> - </p>
            <input type="date" id="stats-end-contracts" value="<?= date('Y-m-d') ?>" onchange="changeContracts()">
        </div>
        <div class="chart" id="contracts-chart"></div>
        <h3 id="contracts-chart-value">Chargement des données ... </h3>
    </div>
    <div class="cell">
        <div class="header">
            <input type="date" id="stats-start-event" value="<?= date('Y-m-d', strtotime('-1 month')) ?>" onchange="changeEvents()">
            <p> - </p>
            <input type="date" id="stats-end-event" value="<?= date('Y-m-d') ?>" onchange="changeEvents()">
        </div>
        <div class="chart" id="events-chart"></div>
        <h3 id="events-chart-value">Chargement des données ... </h3>
    </div>
    <div class="cell">
        <div class="header">
            <input type="date" id="stats-start-client" value="<?= date('Y-m-d', strtotime('-1 month')) ?>" onchange="changeClients()">
            <p> - </p>
            <input type="date" id="stats-end-client" value="<?= date('Y-m-d') ?>" onchange="changeClients()">
        </div>
        <div class="chart" id="clients-chart"></div>
        <h3 id="clients-chart-value">Chargement des données ... </h3>
    </div>
    <div class="cell">
        <div class="header">
            <input type="date" id="stats-start-balance" value="<?= date('Y-m-d', strtotime('-1 month')) ?>" onchange="changeBalance()">
            <p> - </p>
            <input type="date" id="stats-end-balance" value="<?= date('Y-m-d') ?>" onchange="changeBalance()">
        </div>
        <div class="chart" id="balance-chart"></div>
        <h3 id="balance-chart-value">Chargement des données ... </h3>
    </div>
</div>

<!-- Google Charts import -->


<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(loadAllCharts);

    function loadAllCharts() {
        changeContracts();
        changeEvents();
        changeClients();
        changeBalance();
    }

    function changeContracts() {
        let startDate = document.querySelector('#stats-start-contracts').value;
        let endDate = document.querySelector('#stats-end-contracts').value;
        
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadChart(xhr.responseText);
            }
        }
        xhr.open('GET', `controller/live-stats.php?startDate=${startDate}&endDate=${endDate}&desiredStat=nbContracts`, true);
        xhr.send();
    }

    function changeEvents() {
        let startDate = document.querySelector('#stats-start-event').value;
        let endDate = document.querySelector('#stats-end-event').value;
        
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadChart(xhr.responseText);
            }
        }
        xhr.open('GET', `controller/live-stats.php?startDate=${startDate}&endDate=${endDate}&desiredStat=nbEvents`, true);
        xhr.send();
    }

    function changeClients() {
        let startDate = document.querySelector('#stats-start-client').value;
        let endDate = document.querySelector('#stats-end-client').value;
        
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadChart(xhr.responseText);
            }
        }
        xhr.open('GET', `controller/live-stats.php?startDate=${startDate}&endDate=${endDate}&desiredStat=nbClients`, true);
        xhr.send();
    }

    function changeBalance() {
        let startDate = document.querySelector('#stats-start-balance').value;
        let endDate = document.querySelector('#stats-end-balance').value;
        
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadChart(xhr.responseText);
            }
        }
        xhr.open('GET', `controller/live-stats.php?startDate=${startDate}&endDate=${endDate}&desiredStat=balance`, true);
        xhr.send();
    }

    function loadChart(responseText) {
        if (responseText == 'error') return;
        if (responseText.includes('nodata')) {
            let chartName = responseText.split(',')[0]; // get chart name
            document.querySelector('#' + chartName).innerHTML = "<h4>Aucune donnée disponible</h4>";
            document.querySelector('#' + chartName + '-value').innerHTML = "";
            return;
        }
        console.log(responseText);
        
        let chartName = JSON.parse(responseText)[0];
        let data = JSON.parse(responseText)[1];
        let newContractsAmount = JSON.parse(responseText)[2];

        switch (chartName) {
            case 'contracts-chart':
                document.querySelector('#contracts-chart-value').innerHTML = "Nouveaux contrats souscrits : " + newContractsAmount;
                $objectName = "Contrats";
                break;
            case 'events-chart':
                document.querySelector('#events-chart-value').innerHTML = "Nombre de rendez-vous : " + newContractsAmount;
                $objectName = "Rendez-vous";
                break;
            case 'clients-chart':
                document.querySelector('#clients-chart-value').innerHTML = "Nouveaux clients : " + newContractsAmount;
                $objectName = "Clients";
                break;
            case 'balance-chart':
                document.querySelector('#balance-chart-value').innerHTML = "Solde totale : " + newContractsAmount + "€";
                $objectName = "Solde";
                break;
            default:
                $objectName = "error";
                return;
        }

        data = google.visualization.arrayToDataTable([
            ['Date', $objectName],
            ...Object.entries(data)
        ]);


        var options = {
            legend: {position: 'top'},
            vAxis: {minValue: 0},
            series : {
                0: { color: '#b36064' }
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById(chartName));
        chart.draw(data, options);

    }

</script>