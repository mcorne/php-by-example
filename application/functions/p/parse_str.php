<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class parse_str extends function_core
{
    public $examples = [
        [
            "first=value&arr[]=foo+bar&arr[]=baz",
            '$arr'
        ]
    ];

    public $synopsis = 'void parse_str ( string $str [, array &$arr ] )';
}
