<?php
require_once 'view/view.php';

function CtlDisplayLoginPage(){
    displayLoginPage();
}

function CtlGlobalLayout(){
    display('agent', 'view/test.php', 'Agent');
}