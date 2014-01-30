<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

class gmp_gcd extends gmp_abs
{
    public $examples = [
        ["12", "21"]
    ];

    public $synopsis = 'resource gmp_gcd ( resource $a , resource $b )';
}
