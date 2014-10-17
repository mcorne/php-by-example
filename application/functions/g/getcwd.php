<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class getcwd extends function_core
{
    public $hash_result = true;

    public $synopsis = 'string getcwd ( void )';

    public $test_not_validated = true;
}
