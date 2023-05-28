<?php
namespace DueDate\Core;

use DueDate\Core\DueDateManger;
use DueDate\Core\ResultRenderer;

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

            echo '<pre>';
            $result = [
                $dueDateManager->calculateDueDate('2023-02-01 10:11', '4'),////OK
                $dueDateManager->calculateDueDate('2023-02-01 11:11', '7'),////OK


                $dueDateManager->calculateDueDate('2023-02-10 13:10', '28'),
                $dueDateManager->calculateDueDate('2023-02-09 14:12', '17'),

//                $dueDateManager->calculateDueDate('2023-02-01 08:59', '9'),/////correctly FAILeD
//                $dueDateManager->calculateDueDate("2023-02-10 17:10", '1231'),/////correctly FAILeD
//                $dueDateManager->calculateDueDate("2023-02-12 16:01", '12312'),/////correctly FAILeD
            ];
            echo '</pre>';

            (new ResultRenderer($result))->renderResult();

        }
        catch(Exception $err)
        {
            print_r('Something went worng: ' . $err);
            die();
        }
    }
}
