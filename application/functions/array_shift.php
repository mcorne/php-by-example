<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_shift extends function_core
{
    public $source_code = '
$_array =
    $__array; // array $__array;
inject_function_call
';

    public $examples = [
        [
            '__array' => ["orange", "banana", "apple", "raspberry"],
            '$array',
        ],
    ];

    public $input_args = '__array';

    public $synopsis = 'mixed array_shift ( array &$array )';

    function pre_exec_function()
    {
        $this->returned_params['array'] = $this->_filter->filter_param('__array');
    }
}
