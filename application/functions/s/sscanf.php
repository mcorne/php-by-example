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

class sscanf extends function_core
{
    public $examples = [
        [
            "SN/2350001",
            "SN/%d"
        ],
        [
            "January 01 2000",
            '%s %d %d'
        ],
        [
            '_DOUBLE_QUOTES_24\tLewis Carroll_DOUBLE_QUOTES_',
            '_DOUBLE_QUOTES_%d\t%s %s_DOUBLE_QUOTES_',
            '$id',
            '$first',
            '$last',
        ]
    ];

    public $synopsis       = 'mixed sscanf ( string $str , string $format [, mixed &$... ] )';
    public $synopsis_fixed = 'mixed sscanf ( string $str , string $format , mixed &$mixed0 , mixed &$mixed1 , mixed &$mixed2 [, mixed &$... ] )';
}
