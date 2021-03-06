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

class array_udiff extends function_core
{
    public $examples = [
        [
            [
                "a" => "green",
                "b" => "brown",
                "c" => "blue",
                "red"
            ],
            [
                "a" => "GREEN",
                "B" => "brown",
                "yellow",
                "red"
            ],
            'strcasecmp',
        ],
    ];

    public $helper_callbacks = ['index_in_example' => 2, 'function_name_pattern' => '~(cmp$)~'];

    public $synopsis = 'array array_udiff ( array $array1 , array $array2 [, array $... ], callable $value_compare_func )';

    function pre_exec_function()
    {
        $this->_filter->filter_callback('value_compare_func');
    }
}
