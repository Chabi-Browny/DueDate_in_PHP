<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace DueDate\Support;

/**
 * Description of Autoload
 *
 * @author Csaba Barnabas Barcsa
 */
class Autoload 
{
    protected $classMap = [];
    protected $prefixes = [];
    
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }
    
    public function addNameSpaces(string $baseDir, string $prefix, string $prefixAlias)
    {
        
    }

    public function loadClass(){}
    
    public function mappedFiles(){}
    
    public function importFile($filePath)
    {
        if (file_exists($filePath))
        {
            importFile($filePath);
            
            return true;
        }
    }
    
    public function trimPrefix(string $prefix)
    {
        return rtrim($prefix, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
       
}

if (!function_exists('importFile'))
{
    function importFile($filePath)
    {
        include_once $filePath;
    }
}
