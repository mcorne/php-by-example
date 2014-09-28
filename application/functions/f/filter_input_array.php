<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class filter_input_array extends function_core
{
    public $constant_prefix = ['type' => 'INPUT'];

    public $examples = [
        [
            'predefined_var' => '$_POST',
            '__array' => [
                'product_id'    => 'libgd<script>',
                'component'     => '10',
                'versions'      => '2.0.33',
                'testscalar'    => ['2', '23', '10', '12'],
                'testarray'     => '2',
            ],
            "INPUT_POST",
            [
                "product_id" => "FILTER_SANITIZE_ENCODED",
                "component" => [
                    "filter" => "FILTER_VALIDATE_INT",
                    "flags" => "FILTER_REQUIRE_ARRAY",
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
                    "flags" => "FILTER_REQUIRE_ARRAY",
                ],
            ]
        ],
        [
            'predefined_var' => '$_GET',
            '__array' => [
                'product_id'    => 'libgd<script>',
                'component'     => '10',
                'versions'      => '2.0.33',
                'testscalar'    => ['2', '23', '10', '12'],
                'testarray'     => '2',
            ],
            "INPUT_POST",
            [
                "product_id" => "FILTER_SANITIZE_ENCODED",
            ]
        ],
        [
            'predefined_var' => '123',
            '__array' => [
                'product_id'    => 'libgd<script>',
                'component'     => '10',
                'versions'      => '2.0.33',
                'testscalar'    => ['2', '23', '10', '12'],
                'testarray'     => '2',
            ],
            "INPUT_POST",
            [
                "product_id" => "FILTER_SANITIZE_ENCODED",
            ]
        ]
    ];

    public $input_args = ['__array', 'predefined_var'];

    // filter_input_array() cannot be used with examples because changing predefined variables, eg "$_POST" has not effect on it
    public $method_to_exec = 'filter_var_array';

    public $source_code = '
        CHANGEABLE_VAR_predefined_var =
            $__array; // array $__array

        inject_function_call
    ';

    public $synopsis = 'mixed filter_input_array ( int $type [, mixed $definition [, bool $add_empty = true ]] )';

    function _get_options_list()
    {
        $constant_names = array_keys(get_defined_constants());
        $var_names = [];

        foreach ($constant_names as $constant_name) {
            if (preg_match('~^INPUT_~', $constant_name)) {
                $var_name = str_replace('INPUT', '$', $constant_name);
                $var_names[] = $var_name;
            }
        }

        $options_list = ['predefined_var' => $var_names];

        return $options_list;
    }

    function pre_exec_function()
    {
        // creates the corresponding input type, eg "INPUT_POST", from the variable name, eg "$_POST",
        $predefined_var = $this->_filter->filter_var_name('predefined_var');
        $type = str_replace('$', 'INPUT', $predefined_var);

        if (defined($type) and constant($type) === $this->_filter->filter_arg_value('type')) {
            // this is a valid input type, eg "INPUT_POST", sets the "type" arg to the returned "array"
            // this will be passed as the first arg to "filter_var_array()" which is used to simulate "filter_input_array"
            $this->returned_params['type'] = $this->_filter->filter_arg_value('__array');

        } else {
            // the variable and type mismatch, passes an empty array
            $this->returned_params['type'] = [];
        }
    }
}
