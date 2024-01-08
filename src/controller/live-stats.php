<?php
require_once '../model/credentials.php';
require_once '../model/connection.php';
require_once '../model/clientContract.php';
require_once '../model/event.php';
require_once '../model/client.php';
require_once '../model/transaction.php';

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
$desiredStat = $_GET['desiredStat'];

// if start date is before 1950, return "invalid date" error
if ($startDate < '1950-01-01') {
    echo "error";
    return;
}

// if end date is after 2100
if ($endDate > '2100-01-01') {
    echo "error";
    return;
}

// if end date is before start date, return "invalid date" error
if ($endDate < $startDate) {
    echo "error";
    return;
}

switch ($desiredStat) {
    case 'nbContracts':
        $allContracts = getAllContractsBeforeDate($endDate);
        $resultArray = [];
        $newContractsAmount = 0;
        $chartName = "contracts-chart";

        if (empty($allContracts)) {
            echo "$chartName, nodata";
            return;
        }

        // seed array with dates between start and end date
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);
        foreach ($dateRange as $date) {
            $resultArray[$date->format("d-m-Y")] = 0;
        }
        
        // then for each contract, increment the corresponding date and all the following dates
        foreach ($allContracts as $contract) {
            $contractDate = new DateTime($contract->DATEOUVERTURECONTRAT);
            $contractDate = $contractDate->format("d-m-Y");
            foreach ($resultArray as $date => $value) {
                if (strtotime($date) >= strtotime($contractDate)) {
                    $resultArray[$date]++;
                }
            }

            if (strtotime($contract->DATEOUVERTURECONTRAT) > strtotime($startDate)) {
                $newContractsAmount++;
            }
        }

        echo json_encode([$chartName, $resultArray, $newContractsAmount]);
        break;

    case "nbEvents":
        $allEvents = getAllEventsBeforeDate($endDate);
        $resultArray = [];
        $newEventsAmount = 0;
        $chartName = "events-chart";

        if (empty($allEvents)) {
            echo "$chartName, nodata";
            return;
        }

        // seed array with dates between start and end date
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);
        foreach ($dateRange as $date) {
            $resultArray[$date->format("d-m-Y")] = 0;
        }

        // then for each event, increment the corresponding date and all the following dates
        foreach ($allEvents as $event) {
            $eventDate = new DateTime($event->DATERDV);
            $eventDate = $eventDate->format("d-m-Y");
            foreach ($resultArray as $date => $value) {
                if (strtotime($date) >= strtotime($eventDate)) {
                    $resultArray[$date]++;
                }
            }
            if (strtotime($event->DATERDV) > strtotime($startDate)) {
                $newEventsAmount++;
            }
        }

        echo json_encode([$chartName, $resultArray, $newEventsAmount]);
        break;

    case "nbClients":
        $allClients = getAllClientsBeforeDate($endDate);
        $resultArray = [];
        $newClientsAmount = 0;
        $chartName = "clients-chart";

        if (empty($allClients)) {
            echo "$chartName, nodata";
            return;
        }

        // seed array with dates between start and end date
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);
        foreach ($dateRange as $date) {
            $resultArray[$date->format("d-m-Y")] = 0;
        }

        // then for each client, increment the corresponding date and all the following dates
        foreach ($allClients as $client) {
            $clientDate = new DateTime($client->DATEENREGISTREMENT);
            $clientDate = $clientDate->format("d-m-Y");
            foreach ($resultArray as $date => $value) {
                if (strtotime($date) >= strtotime($clientDate)) {
                    $resultArray[$date]++;
                }
            }
            if (strtotime($client->DATEENREGISTREMENT) > strtotime($startDate)) {
                $newClientsAmount++;
            }
        }

        echo json_encode([$chartName, $resultArray, $newClientsAmount]);
        break;
    case "balance":
        $allTransations = getAllTransactionsBeforeDate($endDate);
        $resultArray = [];
        $chartName = "balance-chart";
        $balance = 0;
        if (empty($allTransations)) {
            echo "$chartName, nodata";
            return;
        }

        // seed array with dates between start and end date
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);
        foreach ($dateRange as $date) {
            $resultArray[$date->format("d-m-Y")] = 0;
        }

        // then for each transaction, increment the corresponding date and all the following dates
        foreach ($allTransations as $transaction) {
            $transactionDate = new DateTime($transaction->DATEOP);
            $transactionDate = $transactionDate->format("d-m-Y");
            foreach ($resultArray as $date => $value) {
                if (strtotime($date) >= strtotime($transactionDate)) {
                    if ($transaction->TYPEOP == "debit") {
                        $resultArray[$date] -= $transaction->MONTANT;
                    } else {
                        $resultArray[$date] += $transaction->MONTANT;
                    }
                }
            }
            if ($transaction->TYPEOP == "debit") {
                $balance -= $transaction->MONTANT;
            } else {
                $balance += $transaction->MONTANT;
            }
        }

        echo json_encode([$chartName, $resultArray, $balance]);
        break;
    default:
        $resultArray = [];
}

