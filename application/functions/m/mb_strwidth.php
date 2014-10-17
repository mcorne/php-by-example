<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_strlen.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mb_strwidth extends mb_strlen
{
    public $examples = [
        ["ñ", 'UTF-8'],
        ["n", 'UTF-8'],
        ["現", 'UTF-8'],
    ];

    public $synopsis = 'int mb_strwidth ( string $str [, string $encoding = mb_internal_encoding() ] )';
}
