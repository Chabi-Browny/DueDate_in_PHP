<?php
if (file_exists($rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'Support' . $ds  . 'Autoload.php'))
{
    include_once $rootPath . $ds . 'sys' . $ds . 'DueDate' . $ds .'Support' . $ds  . 'Autoload.php';
}

use DueDate\Support\Autoload;

$dueDateDir = $rootPath . $ds . 'sys';
$autoload = new Autoload();

$autoload->register();

$autoload->addNameSpaces( $dueDateDir, 'DueDate');

