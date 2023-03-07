<?php
declare (strict_types = 1);

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

$rootPath = dirname(__DIR__);
$ds = DIRECTORY_SEPARATOR;

if (file_exists($rootPath . $ds . 'sys' . $ds . 'system.php'))
{
    require_once $rootPath . $ds . 'sys' . $ds . 'system.php';
}
else
{
    header('HTTP/1.1 503 Service unavailable!', true, 503);
    exit();
}