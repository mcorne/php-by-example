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

class rand extends function_core
{
    public $examples = [
        [],
        [5, 15]
    ];

    // public $synopsis    = 'int rand ( void )';
    public $synopsis       = 'int rand ( int $min , int $max )';
    public $synopsis_fixed = 'int rand ( [ int $min [, int $max ]] )';

    public $test_not_validated = true;
}
