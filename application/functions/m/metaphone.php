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
