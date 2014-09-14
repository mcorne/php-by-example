<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
