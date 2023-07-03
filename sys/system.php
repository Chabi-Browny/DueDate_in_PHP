<?php

if (file_exists($rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds . 'systemSupport' . $ds . 'helper_functions.php'))
{
    include_once $rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'systemSupport' . $ds  . 'helper_functions.php';
}

if (file_exists($rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds . 'systemSupport' . $ds . 'autoload.php'))
{
    include_once $rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'systemSupport' . $ds  . 'autoload.php';
}


$duedates = null;

if (file_exists($rootPath . $ds . 'app' . $ds . 'duedate.php'))
{
    $duedates = include_once $rootPath . $ds . 'app' . $ds . 'duedate.php';
}

use DueDate\Core\Application;

(Application::init())->run($duedates);