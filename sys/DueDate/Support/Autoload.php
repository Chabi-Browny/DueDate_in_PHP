<?php

namespace DueDate\Support;

/**
 * Description of Autoload
 * Based on PSR-4
 * @author - P.G.A :), Csaba Barnabas Barcsa 
 */
class Autoload 
{
    protected $classMap = [];
    protected $prefixes = [];
    
    /**/
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }
    
    /**/
    public function addNameSpaces(string $baseDir, string $prefix, string $prefixAlias = ''): void
    {
        $prefix = $this->trimPrefix($prefix);
        
        $baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        
        $toPrefix = strlen($prefixAlias) > 0 
            ? [
                'baseDir' => $baseDir,
                'prefixAlias' => $this->trimPrefix($prefixAlias)
            ] 
            : $baseDir;
        
        if (!array_key_exists($prefix, $this->prefixes)) 
        {
            $this->prefixes[$prefix] = [];
        }
        
        array_push($this->prefixes[$prefix], $toPrefix);
    }

    /**/
    public function loadClass(string $className)
    {
        $prefix = $className;
        
        while ( false !== ($pos = strpos($prefix, '\\')) )
        {
            $prefix = substr($className, 0, $pos + 1);
            
            $relativeClass = substr($className, $pos + 1);
            
            $mappedFile = $this->mappedFiles($prefix, $relativeClass);
            if ($mappedFile)
            {
                return $mappedFile;
            }

            $prefix = rtrim($prefix, '\\');
        }
        
        return false;
    }
    
    /**/
    public function mappedFiles(string $prefix, string $relativeClass)
    {
        
        if (array_key_exists($prefix, $this->prefixes))
        {
            foreach ($this->prefixes[$prefix] as $dirInfo)
            {
                $dirPath = is_array($dirInfo) && array_key_exists('baseDir', $dirInfo) ? $dirInfo['baseDir'] : $dirInfo;
                
                if (is_array($dirInfo) && array_key_exists('prefixAlias', $dirInfo))
                {
                    $prefix = $dirInfo['prefixAlias'];
                }
                
                $fileWithPath = strtr($dirPath . $prefix . $relativeClass . '.php', '/\\', DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR);
                
                if ($this->importFile($fileWithPath))
                {
                    return true;
                }
                
            }            
        }
        
        return false;
    }
    
    /**
     * @desc - Import the file if exists, and gives it back with true
     * @param string $fileWithPath
     * @return bool
     */
    public function importFile(string $fileWithPath)
    {
        if (file_exists($fileWithPath))
        {
            importFile($fileWithPath);
            
            return true;
        }
    }
    
    /**
     * @desc - Right trim the backslash from the prefix
     * @param string $prefix
     * @return type
     */
    public function trimPrefix(string $prefix)
    {
        return rtrim($prefix, '\\') . '\\';
    }
       
}

/**
 * Scope isolated include.©
 *
 * Prevents access to $this/self from included files.©
 */
if (!function_exists('importFile'))
{
    function importFile($fileWithPath)
    {
        include_once $fileWithPath;
    }
}
