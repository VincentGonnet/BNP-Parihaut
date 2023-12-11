<?php
require_once 'view/view.php';

function CtlDisplayLoginPage(){
    displayLoginPage();
}

function CtlGlobalLayout(){
    display('director', 'view/test.php', 'Agent');
}