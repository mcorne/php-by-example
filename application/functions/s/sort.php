<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class sort extends function_core
{
    public $source_code = '
$_array =
    $__array; // array $__array
inject_function_call
';

    public $examples = [
        [
            '__array' => [
                "lemon",
                "orange",
                "banana",
                "apple",
            ],
            '$array',
        ],
        [
            '__array' => [
                "Orange1",
                "orange2",
                "Orange3",
                "orange20",
            ],
            '$array',
            'SORT_NATURAL | SORT_FLAG_CASE',
        ],
    ];

    public $input_args = '__array';

    public $synopsis = 'bool sort ( array &$array [, int $sort_flags = SORT_REGULAR ] )';

    function pre_exec_function()
    {
        $this->returned_params['array'] = $this->_filter->filter_param('__array');
    }
}
