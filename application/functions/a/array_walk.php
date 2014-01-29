<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_walk extends function_core
{
    public $source_code = '
$_test_alter = function (&$item1, $key, $prefix) { $item1 = "$prefix: $item1"; };
$_test_print = function (&$item, $key) { $item = "$key holds $item\n"; };
$_array =
    $__array; // array $__array
inject_function_call
';

    public $examples = [
        [
            '__array' => [
                "d" => "lemon",
                "a" => "orange",
                "b" => "banana",
                "c" => "apple"
            ],
            '$array',
            '$test_print'
        ],
        [
            '__array' => [
                "d" => "lemon",
                "a" => "orange",
                "b" => "banana",
                "c" => "apple"
            ],
            '$array',
            '$test_alter',
            'fruit'
        ],
    ];

    public $helper_callbacks = ['index_in_example' => 1];

    public $input_args = '__array';

    public $synopsis = 'bool array_walk ( array &$array , callable $callback [, mixed $userdata = NULL ] )';

    function pre_exec_function()
    {
        $this->returned_params['array']    = $this->_filter->filter_param('__array');
        $this->returned_params['callback'] = $this->_filter->filter_callback('callback');
    }
}
