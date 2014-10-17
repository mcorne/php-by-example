<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'filter_var_array.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class filter_input_array extends filter_var_array
{
    public $constant_prefix = ['type' => 'INPUT'];

    public $examples = [
        [
            'predefined_var' => '$_POST',
            'data' => [
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
            'data' => [
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
            'predefined_var' => 123,
            'data' => [
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
            'predefined_var' => '$_GET',
            'data' => [
                "width"  => 2,
                "length" => 3,
                "height" => 4,
                "weight" => 5,
            ],
            "INPUT_GET",
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

    public $input_args = ['data', 'predefined_var'];

    // filter_input_array() cannot be used with examples because changing predefined variables, eg "$_POST" has not effect on it
    public $method_to_exec = 'filter_var_array';

    public $source_code = '
        CHANGEABLE_VAR_predefined_var =
            $data; // array $data

        inject_function_call

        // note that filter_input_array() only uses the data passed to the script
        // subsequent changes, as in this example, would actually be ignored
        // filter_input_array() is emulated with filter_var_array() in this example

        // see filter_var_array() for more examples including callbacks
    ';

    public $synopsis         = 'mixed filter_input_array ( int $type [, mixed $definition [, bool $add_empty = true ]] )';
    public $synopsis_to_exec = 'mixed filter_var_array ( array $data [, mixed $definition [, bool $add_empty = true ]] )';

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

        if (! defined($type) or constant($type) !== $this->_filter->filter_arg_value('type')) {
            // the variable and type mismatch, resets the data
            $this->returned_params['data'] = [];
        }

        parent::pre_exec_function();
    }
}
