<?php
namespace DueDate\Core;

use DueDate\Core\DueDateManger;

use Exception;

/**
 * Description of Application
 *
 * @author Csaba Barnabas Barcsa
 */
class Application 
{
    protected static $instance = null;
    
    /**/
    private function __construct() {}
    
    /**/
    public static function init()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    /**/
    public function run()
    {
        try
        {
            $dueDateManager = new DueDateManger();
            
            print_r($dueDateManager->calculateDueDate("2023-02-01 11:11", 7));
            print_r($dueDateManager->calculateDueDate("2023-02-01 08:59", 9));
            print_r($dueDateManager->calculateDueDate("2023-02-10 13:10", 28));
            print_r($dueDateManager->calculateDueDate("2023-02-09 14:12", 17));

            //print_r(calculateDueDate("2023-02-10 17:10", 1231));
            //print_r(calculateDueDate("2023-02-12 17:01", 12312));
        }
        catch(Exception $err)
        {
            print_r('Something went worng: ' . $err);
            die();
        }
    }
}
