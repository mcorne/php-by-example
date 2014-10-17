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

class bccomp extends function_core
{
    public $examples = [
        ['1', '2'],
        ['1.00001', '1', 3],
        ['1.00001', '1', 5]
    ];

    public $synopsis = 'int bccomp ( string $left_operand , string $right_operand [, int $scale ] )';
}
