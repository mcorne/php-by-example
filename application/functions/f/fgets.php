<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'fgetc.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class fgets extends fgetc
{
    public $examples = [
        [
            'data'    =>
                'first line
                second line
                third line
                fourth line
                fifth line',
            '__count' => 2,
            'handle'  => '$handle',
        ],
        [
            'data'    =>
                'first line
                second line
                third line
                fourth line
                fifth line',
            '__count' => 1,
            'handle'  => '$handle',
            'length'  => 11,
        ],
        [
            'data'    =>
                'first line
                second line
                third line
                fourth line
                fifth line',
            '__count' => 5,
            'handle'  => '$handle',
        ],
    ];

    public $synopsis = 'string fgets ( resource $handle [, int $length ] )';
}
