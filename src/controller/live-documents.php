<?php
session_start();
require_once '../model/credentials.php';
require_once '../model/connection.php';
require_once '../view/advisor/client-documents.php';
require_once '../model/documents.php';
require_once '../controller/front-controller.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


if(isset($_GET['checkboxesState'])){
    $fullchecked = $_GET['checkboxesState'];
    echo $fullchecked;
    $fullchecked = filter_var($fullchecked, FILTER_VALIDATE_BOOLEAN);

        if ($fullchecked){
            $_SESSION['checkboxesState'] = true;
            
        }
}



