<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class current extends function_core
{
    public $source_code = '
$_array =
    $__array; // array $__array
$count =
    $__count; // int $__count
for ($i = 0; $i < $count; $i++) { next($_array); }
inject_function_call
';

    public $examples = [
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 2,
            '$array',
        ],
    ];

    public $input_args = ['__array', '__count'];

    public $synopsis = 'mixed current ( array &$array )';

    function post_exec_function()
    {
        // this is a dirty fix to ensure that false is returned when there are more next() actions than the array has values
        $this->pre_exec_function();
        $result[$this->_synopsis->return_var] = current($this->returned_params['array']);
        $this->result = $result;
    }

    function pre_exec_function()
    {
        $this->returned_params['array'] = $this->_filter->filter_param('__array');
        $count = $this->_filter->filter_iteration_count('__count');

        for ($i = 0; $i < $count; $i++) {
            next($this->returned_params['array']);
        }
    }
}
