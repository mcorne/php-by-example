<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom/pbx_filter_imported_vars.php';
require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class extract extends function_core
{
    public $examples = [
        [
            'var1'  => '$size',
            'data1' => "large",
            [
                "color" => "blue",
                "size"  => "medium",
                "shape" => "sphere",
            ],
            "EXTR_PREFIX_SAME",
            "wddx"
        ],
        [
            'var1'  => '$color',
            'data1' => "red",
            'var2'  => '$size',
            'data2' => "large",
            'var3'  => '$shape',
            'data3' => "cube",
            [
                "color" => "blue",
                "size"  => "medium",
                "shape" => "sphere",
            ],
        ],
        [
            'var1'  => '$color',
            'data1' => "red",
            'var2'  => '$size',
            'data2' => "large",
            'var3'  => '$shape',
            'data3' => "cube",
            [
                "color" => "blue",
                "size"  => "medium",
                "shape" => "sphere",
            ],
            "EXTR_SKIP",
        ],
        [
            [
                "123" => "blue",
                "size"  => "medium",
                "shape" => "sphere",
            ],
            "EXTR_PREFIX_INVALID",
            "wddx"
        ]
    ];

    public $input_args = ['data1', 'data2', 'data3', 'var1', 'var2', 'var3'];

    public $method_to_exec = false;

    public $source_code = '
        // enter variable names and values to test collisions (optional)
        CHANGEABLE_VAR_var1 =
            $data1; // mixed $data1
        CHANGEABLE_VAR_var2 =
            $data2; // mixed $data2
        CHANGEABLE_VAR_var3 =
            $data3; // mixed $data3

        inject_function_call

        // the imported variables are displayed along with the result
        // they are extracted from get_defined_vars() with pbx_filter_imported_vars()
    ';

    public $synopsis       = 'int extract ( array &$array [, int $flags = EXTR_OVERWRITE [, string $prefix = NULL ]] )';
    public $synopsis_fixed = 'int extract ( array $array  [, int $flags = EXTR_OVERWRITE [, string $prefix = NULL ]] )'; // no need to pass the array by reference

    function get_params()
    {
        $params = [];
        $array = null;
        $prefix = null;

        if ($this->_function_params->param_exists('array')) {
            $params[] = $array = $this->_function_params->get_param('array', true);
            $var_names = array_keys($array);

            if ($this->_function_params->param_exists('flags')) {
                $params[] = $this->_function_params->get_param('flags', true);

                if ($this->_function_params->param_exists('prefix')) {
                    $params[] = $prefix = $this->_function_params->get_param('prefix', true);
                }
            }
        }

        return [$params, $var_names, $prefix];
    }

    function get_variables()
    {
        $indexes = range(1, 3);
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
        if ($variables = $this->get_variables()) {
            // makes the variables available in the current scope
            extract($variables);
        }

        list($params, $var_names, $prefix) = $this->get_params();

        if (! $params) {
            return;
        }

        $this->result['int'] = call_user_func_array('extract', $params);

        // extracts the defined variables from the current scope
        $defined_vars = get_defined_vars();

        if ($imported_vars = pbx_filter_imported_vars($defined_vars, $var_names, $prefix)) {
            $this->result += $imported_vars;
        }
    }
}
