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

class gmp_div_q extends gmp_abs
{
    public $examples = [
        ["100", "5"],
        ["1", "3"],
        ["1", "3", 'GMP_ROUND_PLUSINF'],
        ["-1", "4", 'GMP_ROUND_PLUSINF'],
        ["-1", "4", 'GMP_ROUND_MINUSINF']
    ];

    public $synopsis = 'resource gmp_div_q ( resource $a , resource $b [, int $round = GMP_ROUND_ZERO ] )';
}
