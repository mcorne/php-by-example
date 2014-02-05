<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class number_format extends function_core
{
    public $examples = [
        1234.56,
        [1234.56, 2, ',', ' '],
        [1234.5678, 2, '.', '']
    ];

    // public $synopsis = 'string number_format ( float $number [, int $decimals = 0 ] )';
    public $synopsis = 'string number_format ( float $number , int $decimals = 0 , string $dec_point = "." , string $thousands_sep = "," )';
}
