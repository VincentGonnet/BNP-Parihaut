<?php
function getPhpFile($file)
{
    ob_start();
    include $file;
    return ob_get_clean();
}

function display($job, $viewFile, $title)
{
    // TODO: changer la nav en fonction du job, compléter le switch
    switch ($job) {
        case 'director':
            // director nav
            break;
        case 'advisor':
            // advisor nav
            break;
        case 'agent':
            // agent nav
            break;
        default:
            $nav = '<p>Please login</p>';
    }

    $view = getPhpFile($viewFile);
    $head = '<h1>' . $title . '</h1>';
    require_once 'global-layout.php';
}