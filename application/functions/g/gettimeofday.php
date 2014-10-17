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

class gettimeofday extends function_core
{
    public $examples = [
        [],
        true
    ];

    public $synopsis = 'mixed gettimeofday ([ bool $return_float = false ] )';

    public $test_not_validated = true;
}
