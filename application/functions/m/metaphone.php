<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class metaphone extends function_core
{
    public $examples = [
        "programming",
        "programmer",
        ["programming", 5],
        ["programmer", 5]
    ];

    public $synopsis = 'string metaphone ( string $str [, int $phonemes = 0 ] )';
}
