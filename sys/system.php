<?php

if (file_exists($rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds . 'systemSupport' . $ds . 'helper_functions.php'))
{
    include_once $rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'systemSupport' . $ds  . 'helper_functions.php';
}

if (file_exists($rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds . 'systemSupport' . $ds . 'autoload.php'))
{
    include_once $rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'systemSupport' . $ds  . 'autoload.php';
}

use DueDate\Core\Application;

(Application::init())->run();