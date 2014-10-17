<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/m/mktime.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class getlastmod extends mktime
{
    public $examples = [[]]; // resets examples as in function_core

    public $synopsis       = 'int getlastmod ( void )';
    public $synopsis_fixed = null;

    public $test_not_validated = true;
}
