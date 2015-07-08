<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class bcscale extends function_core
{
    public $examples = [
        [
            3,
            'left_operand' => 1.23456,
            'right_operand' => 5,
        ],
    ];

    public $input_args = ['left_operand', 'right_operand'];

    public $source_code = '
        inject_function_call

        // shows the effect of the scale on the addition
        $string = bcadd (
            $left_operand, // string $left_operand
            $right_operand // string $right_operand
        );
    ';

    public $synopsis = 'bool bcscale ( int $scale )';

    function post_exec_function()
    {
        $left_operand = $this->_filter->filter_arg_value('left_operand');
        $right_operand = $this->_filter->filter_arg_value('right_operand');

        $this->result['string'] = bcadd($left_operand, $right_operand);

        bcscale(0); // restores the default scale
    }
}
