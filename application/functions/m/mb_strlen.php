<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_convert_case.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class mb_strlen extends mb_convert_case
{
    public $examples = [
        ["español", 'UTF-8'],
    ];

    public $source_code = '
        mb_internal_encoding("UTF-8");

        inject_function_call

        // enter non ASCII characters in hex in $_str if $_encoding is not UTF-8
    ';

    public $synopsis = 'mixed mb_strlen ( string $str [, string $encoding = mb_internal_encoding() ] )';
}
