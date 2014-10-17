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

class gmp_divexact extends gmp_abs
{
    public $examples = [
        ["10", "2"],
        ["10", "3"]
    ];

    public $synopsis = 'resource gmp_divexact ( resource $n , resource $d )';

    public $test_not_validated = 1;
}
