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

class preg_quote extends function_core
{
    public $examples = [
        ['$40 for a g3/400', "/"],
        '*very*'
    ];

    public $synopsis = 'string preg_quote ( string $str [, string $delimiter = NULL ] )';
}
