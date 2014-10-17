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

class gmp_strval extends function_core
{
    public $examples = ["0x41682179fbf5", 123];

    public $synopsis = 'string gmp_strval ( resource $gmpnumber [, int $base = 10 ] )';
}
