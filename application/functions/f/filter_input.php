<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'filter_var.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class filter_input extends filter_var
{
    public $constant_prefix = ['type' => 'INPUT'];

    public $examples = [
        [
            'predefined_var' => '$_GET',
            'data' => [
                'search'    => 'libgd<script>',
            ],
            "INPUT_GET",
            "search",
            "FILTER_SANITIZE_SPECIAL_CHARS"
        ],
        [
            'predefined_var' => '$_GET',
            'data' => [
                'search'    => 'libgd<script>',
            ],
            "INPUT_GET",
            "search",
            "FILTER_SANITIZE_ENCODED"
        ],
        [
            'predefined_var' => '$_POST',
            'data' => [
                'number'    => 3,
            ],
            "INPUT_POST",
            "number",
            "FILTER_CALLBACK",
            [
                "options" => "cube",
            ]
        ],
        // used in translations_in_action.php
        [
            'predefined_var' => 'xyz',
            'data' => [
                'number'    => 3,
            ],
            "INPUT_POST",
            "number",
            "FILTER_CALLBACK",
            [
                "options" => "cube",
            ]
        ],
    ];

    public $input_args = ['data', 'predefined_var'];

    // filter_input() cannot be used with examples because changing predefined variables, eg "$_POST" has not effect on it
    public $method_to_exec = 'filter_var';

    public $source_code = '
        CHANGEABLE_VAR_predefined_var =
            $data; // array $data

        inject_function_call

        // note that filter_input() only uses the data passed to the script
        // subsequent changes, as in this example, would actually be ignored
        // filter_input() is emulated with filter_var() in this example

        // see filter_var() for more examples including callbacks
    ';

    public $synopsis         = 'mixed filter_input ( int $type , string $variable_name [, int $filter = FILTER_DEFAULT [, mixed $options ]] )';
    public $synopsis_to_exec = 'mixed filter_var ( mixed $variable [, int $filter = FILTER_DEFAULT [, mixed $options ]] )';

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
        // adds the "variable" arg expected by filter_var()
        $this->_function_params->set_param('variable', null);

        // creates the corresponding input type, eg "INPUT_POST", from the variable name, eg "$_POST",
        $predefined_var = $this->_filter->filter_var_name('predefined_var');
        $type = str_replace('$', 'INPUT', $predefined_var);

        if (! defined($type) or constant($type) !== $this->_filter->filter_arg_value('type')) {
            // the variable and type mismatch, resets the data
            $this->returned_params['data'] = [];

        } else if ($variable_name = $this->_filter->filter_arg_value('variable_name') and
            $data = $this->_filter->filter_arg_value('data') and
            isset($data[$variable_name]))
        {
            // there is data for that variable name, sets the variable
            $this->returned_params['variable'] = $data[$variable_name];
        }

        parent::pre_exec_function();
    }
}
