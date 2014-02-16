<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
            "24\tLewis Carroll",
            "%d\t%s %s",
            '$id',
            '$first',
            '$last',
        ]
    ];

    public $synopsis       = 'mixed sscanf ( string $str , string $format [, mixed &$... ] )';
    public $synopsis_fixed = 'mixed sscanf ( string $str , string $format , mixed &$mixed0 , mixed &$mixed1 , mixed &$mixed2 [, mixed &$... ] )';
}
