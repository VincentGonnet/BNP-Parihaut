<?php
require_once '../model/credentials.php';
require_once '../model/connection.php';
require_once '../model/employee.php';
require_once '../view/view.php';

$input = $_GET['liveSearchEmployees'];

$resultArray = liveSearchEmployee($input);

if (empty($resultArray)) {
    echo '<tr><td colspan="5" style="height: 50px;">Aucun résultat...</td></tr>';
    return;
}

foreach ($resultArray as $employee) {
    require '../view/components/employee-table-row.php';
}