<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

class gmp_sub extends gmp_abs
{
    public $examples = [
        ["281474976710656", "4294967296"],
        ["5", "3"]
    ];

    public $synopsis = 'resource gmp_sub ( resource $a , resource $b )';
}
