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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class gmp_popcount extends function_core
{
    public $examples = [
        [
            'number' => "10000101",
            'base'   => 2,
            '$a',
        ],
        [
            'number' => "11111110",
            'base'   => 2,
            '$a',
        ],
    ];

    public $source_code = '
        $_a = gmp_init(
            $number, // mixed $number
            $base // [int $base = 0]
        );

        inject_function_call
    ';

    public $synopsis = 'int gmp_popcount ( resource $a )';

    function pre_exec_function()
    {
        $number = $this->_filter->filter_arg_value('number');
        $base = $this->_filter->filter_arg_value('base');
        $this->returned_params['a'] = gmp_init($number, $base);
    }
}
