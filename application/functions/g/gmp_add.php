<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

class gmp_add extends gmp_abs
{
    public $examples = [
        ["123456789012345", "76543210987655"],
        ["3", "2"]
    ];

    public $synopsis = 'resource gmp_add ( resource $a , resource $b )';
}
