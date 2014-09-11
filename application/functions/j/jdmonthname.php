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
    public $examples = [
        [2451545, 0]
    ];

    public $options_range = ['mode' => [0, 5]];

    public $synopsis = 'string jdmonthname ( int $julianday , int $mode )';
}
