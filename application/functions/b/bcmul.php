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

class bcmul extends function_core
{
    public $examples = [
        ['1.34747474747', '35', 3],
        ['2', '4']
    ];

    public $synopsis = 'string bcmul ( string $left_operand , string $right_operand [, int $scale ] )';
}
