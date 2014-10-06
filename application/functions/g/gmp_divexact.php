<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

class gmp_divexact extends gmp_abs
{
    public $examples = [
        ["10", "2"],
        ["10", "3"]
    ];

    public $synopsis = 'resource gmp_divexact ( resource $n , resource $d )';

    public $test_not_validated = 1;
}
