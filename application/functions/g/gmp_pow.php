<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

class gmp_pow extends gmp_abs
{
    public $examples = [
        ["2", 31],
        ["0", 0],
        ["2", -1]
    ];

    public $synopsis = 'resource gmp_pow ( resource $base , int $exp )';
}
