<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class gmp_perfect_square extends function_core
{
    public $examples = ["9", "7", "1524157875019052100"];

    public $synopsis = 'bool gmp_perfect_square ( resource $a )';
}
