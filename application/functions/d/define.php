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

class define_ extends function_core
{
    public $constant_as_string = ['name' => true];

    public $examples = [
        [
            "CONSTANT",
            "Hello world."
        ],
        [
            "GREETING",
            "Hello you.",
            true
        ],
        [
            "E_ALL",
            "123",
        ],
        [
            "ARRAY",
            [123],
        ]
    ];

    public $source_code = '
        inject_function_call

        // shows if the constant is defined regardless of the case
        // note that $name below actually represents an argument
        if ($bool) {
            $is_defined = defined(strtolower($name));
        }
    ';

    public $synopsis = 'bool define ( string $name , mixed $value [, bool $case_insensitive = false ] )';

    function post_exec_function()
    {
        if ($this->result['bool']) {
            $name = $this->_filter->filter_arg_value('name');
            $this->result['is_defined'] = defined(strtolower($name));
        }
    }
}
