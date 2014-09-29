<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class filter_var_array extends function_core
{
    public $examples = [
        [
            [
                "product_id" => "libgd<script>",
                "component" => "10",
                "versions" => "2.0.33",
                "testscalar" => [
                    0 => "2",
                    1 => "23",
                    2 => "10",
                    3 => "12",
                ],
                "testarray" => "2",
            ],
            [
                "product_id" => "FILTER_SANITIZE_ENCODED",
                "component" => [
                    "filter" => "FILTER_VALIDATE_INT",
                    "flags" => "FILTER_FORCE_ARRAY",
                    "options" => [
                        "min_range" => 1,
                        "max_range" => 10,
                    ],
                ],
                "versions" => "FILTER_SANITIZE_ENCODED",
                "doesnotexist" => "FILTER_VALIDATE_INT",
                "testscalar" => [
                    "filter" => "FILTER_VALIDATE_INT",
                    "flags" => "FILTER_REQUIRE_SCALAR",
                ],
                "testarray" => [
                    "filter" => "FILTER_VALIDATE_INT",
                    "flags" => "FILTER_FORCE_ARRAY",
                ],
            ]
        ],
        [
            [
                "width"  => 2,
                "length" => 3,
                "height" => 4,
                "weight" => 5,
            ],
            [
                "width" => [
                    "filter" => "FILTER_CALLBACK",
                    "options" => "double",
                ],
                "length" => [
                    "filter" => "FILTER_CALLBACK",
                    "options" => '$cube',
                ],
                "height" => [
                    "filter" => "FILTER_CALLBACK",
                    "options" => "pbx_callbacks::double",
                ],
                "weight" => [
                    "filter" => "FILTER_CALLBACK",
                    "options" => ['$object', 'cube'],
                ],
            ]
        ]
    ];

    public $source_code = '
        // custom callback functions
        function cube($n)       { return($n * $n * $n); }
        function double($value) { return $value * 2; }

        // adds custom callback functions, closures and methods
        require "pbx_callbacks.php";
        $object = new pbx_callbacks();

        inject_function_call
    ';

    public $synopsis = 'mixed filter_var_array ( array $data [, mixed $definition [, bool $add_empty = true ]] )';

    function pre_exec_function()
    {
        if (! $definition = $this->_filter->filter_arg_value('definition') or ! is_array($definition)) {
            return;
        }

        foreach ($definition as $arg_name => &$arg_definition) {
            // names the callback after the arg name
            $callback_name = "callback_$arg_name";

            if (isset($arg_definition['filter']) and $arg_definition['filter'] == FILTER_CALLBACK and
                isset($arg_definition['options']) and ! $this->_function_params->param_exists($callback_name))
            {
                // there is a callback and it has not been processed yet, adds the callback param
                $this->_function_params->set_param($callback_name, $arg_definition['options']);
                // updates the callback in case an object or a closuse is returned
                $arg_definition['options'] = $this->_filter->filter_callback($callback_name);
                $definition_has_changed = true;
            }
        }

        if (! empty($definition_has_changed)) {
            $this->returned_params['definition'] = $definition;
        }

    }
}
