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
