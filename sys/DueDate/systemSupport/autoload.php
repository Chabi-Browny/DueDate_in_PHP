<?php
if (file_exists($rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'Support' . $ds  . 'Autoload.php'))
{
    include_once $rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'Support' . $ds  . 'Autoload.php';
}

use DueDate\Support\Autoload;

$autoload = new Autoload();

$autoload->register();

$autoload->addNameSpaces( $rootPath . $ds . 'sys', 'DueDate');

$autoload->addNameSpaces( $rootPath . $ds, 'App', 'app');