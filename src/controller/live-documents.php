<?php
session_start();
require_once '../model/credentials.php';
require_once '../model/connection.php';
require_once '../model/documents.php';


if(isset($_GET['checkboxesState'])){
    $fullchecked = $_GET['checkboxesState'];
    $fullchecked = filter_var($fullchecked, FILTER_VALIDATE_BOOLEAN);

    if ($fullchecked){
        $_SESSION['allChecked'] = true;
    } else {
        $_SESSION['allChecked'] = false;
    }
}



