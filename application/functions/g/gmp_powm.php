<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

class gmp_powm extends gmp_abs
{
    public $examples = [
        ["2", "31", "2147483649"],
        ["3", "2", "4"]
    ];

    public $synopsis = 'resource gmp_powm ( resource $base , resource $exp , resource $mod )';
}
