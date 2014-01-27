<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
