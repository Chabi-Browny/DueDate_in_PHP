<?php

if (!function_exists('vdx'))
{
    function vdx($dataToShow)
    {
        echo '<pre>';
        var_dump($dataToShow);
        echo '</pre>';
    }
}

/**/
if (!function_exists('dd'))
{
    function dd($dataToShow)
    {
        echo '<pre>';
        var_dump($dataToShow);
        echo '</pre>';
        die('method: ' . __METHOD__ . ' at line: ' . __LINE__);
    }
}