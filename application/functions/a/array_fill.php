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

class array_fill extends function_core
{
    public $examples = [
        [5, 6, 'banana'],
        [-2, 4, 'pear'],
    ];

    public $synopsis = 'array array_fill ( int $start_index , int $num , mixed $value )';
}
