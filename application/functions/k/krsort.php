<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class krsort extends function_core
{
    public $source_code = '
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
        ],
    ];

    public $input_args = '__array';

    public $synopsis = 'bool krsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )';

    function pre_exec_function()
    {
        $this->returned_params['array'] = $this->_filter->filter_param('__array');
    }
}
