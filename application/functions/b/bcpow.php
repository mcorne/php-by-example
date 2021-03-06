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

class bcpow extends function_core
{
    public $examples = [
        ['5', '2', 2]
    ];

    public $synopsis = 'string bcpow ( string $left_operand , string $right_operand [, int $scale ] )';
}
