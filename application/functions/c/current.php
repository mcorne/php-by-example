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

class current extends function_core
{
    public $examples = [
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 2,
            '$array',
        ],
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 0,
            '$array',
        ],
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 9,
            '$array',
        ],
        [
            '__array' => 123,
            '__count' => 2,
            '$array',
        ],
        [
            '__array' => null,
            '__count' => 2,
            '$array',
        ],
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 123,
            '$array',
        ],
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 'xyz',
            '$array',
        ],
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 2,
            '$xyz',
        ],
        // used in translations_in_action.php
        [
            '__array' => ['foot', 'bike', 'car', 'plane'],
            '__count' => 99,
            '$array',
        ],
    ];

    public $input_args = ['__array', '__count'];

    public $source_code = '
        $_array =
            $__array; // array $__array

        $count =
            $__count; // int $__count

        for ($i = 0; $i < $count; $i++) {
            _NO_BOLD_next($_array);
        }

        inject_function_call
    ';

    public $synopsis = 'mixed current ( array &$array )';

    function post_exec_function()
    {
        // this fix is necessary because current() does not return the proper value when processed through the default (parent) post_exec_function()
        $function = $this->_synopsis->function_name;
        $result[$this->_synopsis->return_var] = $function($this->returned_params['array']);
        $this->result = $result;

        if ($this->errors) {
            // there are errors, removes the last error that would be a duplicate of the previous one,
            // eg "current() expects parameter 1 to be array, null given"
            $this->errors = array_slice($this->errors, 0, -1);
        }
    }

    function pre_exec_function()
    {
        $this->returned_params['array'] = $this->_filter->filter_arg_value('array');
        $count = $this->_filter->filter_iteration_count('__count');

        for ($i = 0; $i < $count; $i++) {
            next($this->returned_params['array']);
        }
    }
}
