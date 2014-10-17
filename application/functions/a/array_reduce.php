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

class array_reduce extends function_core
{
    public $examples = [
        [
            [1, 2, 3, 4, 5],
            'rsum',
        ],
        [
            [1, 2, 3, 4, 5],
            'rmul',
            10
        ],
        [
            [],
            'rsum',
            "No data to reduce"
        ],
    ];

    public $helper_callbacks = ['index_in_example' => 1];

    public $source_code = '
        // custom callback functions
        function rsum($v, $w) { $v += $w; return $v; };
        function rmul($v, $w) { $v *= $w; return $v; };

        inject_function_call
    ';

    public $synopsis = 'mixed array_reduce ( array $array , callable $callback [, mixed $initial = NULL ] )';

    function pre_exec_function()
    {
        $this->_filter->filter_callback('callback');
    }
}
