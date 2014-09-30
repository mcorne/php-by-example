<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class compact extends function_core
{
    public $examples = [
        [
            'var1' => '$city',
            'data1' => "San Francisco",
            'var2' => '$state',
            'data2' => "CA",
            'var3' => '$event',
            'data3' => "SIGGRAPH",
            'var4' => '$location_vars',
            'data4' => ["city", "state"],
            'event',
            "nothing_here",
            '$location_vars',
        ],
        [
            'var1' => '$city',
            'data1' => "San Francisco",
        ],
    ];

    public $input_args = ['data1', 'data2', 'data3', 'data4', 'var1', 'var2', 'var3', 'var4'];

    public $source_code = '
        CHANGEABLE_VAR_var1 =
            $data1; // mixed $data1
        CHANGEABLE_VAR_var2 =
            $data2; // mixed $data2
        CHANGEABLE_VAR_var3 =
            $data3; // mixed $data3
        CHANGEABLE_VAR_var4 =
            $data4; // mixed $data4

        inject_function_call
    ';

    public $synopsis       = 'array compact ( mixed $varname1 [, mixed $... ] )';
    public $synopsis_fixed = 'array compact ( mixed $varname1 [, mixed $varname2 [, mixed $varname3 [, mixed $varname4, mixed $... ]]] )';

    function post_exec_function()
    {
        $indexes = range(1, 4);

        foreach ($indexes as $index) {
            if ($varname = $this->_filter->filter_var_name('var' . $index, false)) {
                $varname = substr($varname, 1);
                $this->returned_params[$varname] = $this->_filter->filter_arg_value('data' . $index);
            }
        }

        if (! extract($this->returned_params)) {
            // no variables are set
            return;
        }

        foreach ($indexes as $index) {
            $param_name = 'varname' . $index;
            if ($this->_function_params->param_exists($param_name)) {
                $varnames[] = $this->_function_params->get_param($param_name, true);
            }
        }

        if ($varnames) {
            // one or more variable names are passed, compacts the variables
            // compacting may only be done in the scope where the variables are available
            // setting the variables in pre_exec_function() prior to exec_function() wwould have no effect
            $this->result['array'] = call_user_func_array('compact', $varnames);
        }
    }
}
