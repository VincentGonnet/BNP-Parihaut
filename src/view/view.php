<?php
function getPhpFile($file)
{
    ob_start();
    include $file;
    return ob_get_clean();
}

function display($job, $viewFile, $title)
{
    switch ($job) {
        case 'director':
            $nav=getPhpFile("sidebars/sidebar-director.php");
            break;
        case 'advisor':
            $nav=getPhpFile("sidebars/sidebar-advisor.php");
            break;
        case 'agent':
            $nav=getPhpFile("sidebars/sidebar-agent.php");
            break;
        default:
            $nav = '<p>Please login</p>';
    }

    $view = getPhpFile($viewFile);
    $head = '<h1>' . $title . '</h1>';
    require_once 'global-layout.php';
}

function displayLoginPage(){
    require_once 'login-page.php';
}