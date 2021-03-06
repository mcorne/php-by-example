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

class compact extends function_core
{
    public $examples = [
        [
            'var1'  => '$city',
            'data1' => "San Francisco",
            'var2'  => '$state',
            'data2' => "CA",
            'var3'  => '$event',
            'data3' => "SIGGRAPH",
            'var4'  => '$location_vars',
            'data4' => ["city", "state"],
            'event',
            "nothing_here",
            '$location_vars',
        ],
        [
            'var1'  => '$city',
            'data1' => "San Francisco",
        ],
    ];

    public $input_args = ['data1', 'data2', 'data3', 'data4', 'var1', 'var2', 'var3', 'var4'];

    public $source_code = '
        // enter variable names and values to be compacted
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

    function get_var_names()
    {
        $indexes = range(1, 4);
        $varnames = [];

        foreach ($indexes as $index) {
            $param_name = 'varname' . $index;
            if ($this->_function_params->param_exists($param_name)) {
                $varnames[] = $this->_function_params->get_param($param_name, true);
            }
        }

        return $varnames;
    }

    function get_variables()
    {
        $indexes = range(1, 4);
        $variables = [];

        foreach ($indexes as $index) {
            if ($varname = $this->_filter->filter_var_name('var' . $index, false)) {
                $param_name = substr($varname, 1);
                $variables[$param_name] = $this->_filter->filter_arg_value('data' . $index);
            }
        }

        return $variables;
    }

    function post_exec_function()
    {
        // makes the variables available in the current scope
        // because compact() only looks for a variable based on its name in the current symbol table
        // note that setting the variables in pre_exec_function() with the help of $GLOBALS
        // would have not effect when exec_function() would process compact()

        if (! $this->returned_params = $this->get_variables() or ! extract($this->returned_params)) {
            // no variables are set
            return;
        }

        if ($varnames = $this->get_var_names()) {
            // one or more variable names are passed, compacts the variables
            $this->result['array'] = call_user_func_array('compact', $varnames);
        }
    }
}
