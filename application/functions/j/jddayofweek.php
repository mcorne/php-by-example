<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class jddayofweek extends function_core
{
    public $constant_prefix = ['mode' => 'CAL_DOW'];

    public $examples = [
        2451545,
        [2451545, 'CAL_DOW_LONG'],
    ];

    public $synopsis = 'mixed jddayofweek ( int $julianday [, int $mode = CAL_DOW_DAYNO ] )';
}
