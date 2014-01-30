<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

class gmp_mod extends gmp_abs
{
    public $examples = [
        ["8", "3"]
    ];

    public $synopsis = 'resource gmp_mod ( resource $n , resource $d )';
}
