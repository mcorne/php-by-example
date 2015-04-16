<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pdo__getavailabledrivers extends function_core
{
    public $synopsis = 'public static array PDO::getAvailableDrivers ( void )';
    
    public $test_not_validated = true;
}
