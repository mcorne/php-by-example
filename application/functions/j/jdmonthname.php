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

class jdmonthname extends function_core
{
    public $constant_prefix = ['mode' => 'CAL_MONTH'];

    public $examples = [
        [2451545, 0],
        [2451545, 'CAL_MONTH_GREGORIAN_LONG']
    ];

    public $synopsis = 'string jdmonthname ( int $julianday , int $mode )';
}
