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

class gmp_gcd extends gmp_abs
{
    public $examples = [
        ["12", "21"]
    ];

    public $synopsis = 'resource gmp_gcd ( resource $a , resource $b )';
}
