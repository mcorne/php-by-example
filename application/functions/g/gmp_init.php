<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class gmp_init extends gmp_abs
{
    public $examples = [123456, "0xFFFFDEBACDFEDF7200"];

    public $synopsis = 'resource gmp_init ( mixed $number [, int $base = 0 ] )';
}
