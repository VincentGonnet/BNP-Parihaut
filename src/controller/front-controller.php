<?php

require_once 'controller/controller.php';

if (isset($_POST['connection'])){
    CtlGlobalLayout();
} else{
    CtlDisplayLoginPage();
}


