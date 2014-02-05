<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_multisort extends function_core
{
    public $source_code = '
$_array1 =
    $__array1; // array $__array1;
$_array2 =
    $__array2; // array $__array2;
$_array3 =
    $__array3; // array $__array3;
inject_function_call
';

    public $examples = [
        [
            '__array1' => [10, 100, 100, 0],
            '$array1',
            'SORT_ASC',
            'SORT_REGULAR',
            '__array2' => [1, 3, 2, 4],
            '$array2',
        ],
        [
            '__array1' => ["10", 11, 100, 100, "a"],
            '$array1',
            'SORT_ASC',
            'SORT_STRING',
            '__array2' => [1, 2, "2",  3,  1],
            '$array2',
            'SORT_NUMERIC',
            'SORT_DESC',
        ],
        [
            '__array1' => [67, 86, 85, 98, 86, 67],
            '$array1',
            'SORT_DESC',
            'SORT_REGULAR',
            '__array2' => [2, 1, 6, 2, 6, 7],
            '$array2',
            'SORT_ASC',
            'SORT_REGULAR',
            '__array3' => [
                ['volume' => 67, 'edition' => 2],
                ['volume' => 86, 'edition' => 1],
                ['volume' => 85, 'edition' => 6],
                ['volume' => 98, 'edition' => 2],
                ['volume' => 86, 'edition' => 6],
                ['volume' => 67, 'edition' => 7],
            ],
            '$array3',
        ],
        [
            '__array1' => ['alpha', 'atomic', 'beta', 'bank'],
            '$array1',
            'SORT_ASC',
            'SORT_STRING',
            '__array2' => ['Alpha', 'atomic', 'Beta', 'bank'],
            '$array2',
        ],
    ];

    public $input_args = ['__array1', '__array2', '__array3'];

    public $synopsis       = 'bool array_multisort ( array &$array1 [, mixed $array1_sort_order = SORT_ASC [, mixed $array1_sort_flags = SORT_REGULAR [, mixed $... ]]] )';
    public $synopsis_fixed = 'bool array_multisort ( array &$array1 [, mixed $array1_sort_order = SORT_ASC [, mixed $array1_sort_flags = SORT_REGULAR [, array &$array2 [, mixed $array2_sort_order = SORT_ASC [, mixed $array2_sort_flags = SORT_REGULAR [, array &$array3 [, mixed $array3_sort_order = SORT_ASC [, mixed $array3_sort_flags = SORT_REGULAR [, mixed $... ]]]]]]]]] )';

    function pre_exec_function()
    {
        $this->returned_params['array1'] = $this->_filter->filter_param('array1');
        $this->returned_params['array2'] = $this->_filter->filter_param('array2');
        $this->returned_params['array3'] = $this->_filter->filter_param('array3');
    }
}
