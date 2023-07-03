<?php
namespace DueDate\Core;

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
    public function run(array $duedateResult)
    {
        try
        {
            (new ResultRenderer($duedateResult))->renderResult();
        }
        catch(Exception $err)
        {
            print_r('Something went worng: ' . $err);
            die();
        }
    }
}
