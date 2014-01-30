<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

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
