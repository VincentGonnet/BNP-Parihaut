<?php
require_once 'view/view.php';

function CtlDisplayLoginPage(){
    displayLoginPage();
}

function CtlGlobalLayout(){
    $nav = getPhpFile('sidebar-agent.php');
    require_once 'view/global-layout.php';
}