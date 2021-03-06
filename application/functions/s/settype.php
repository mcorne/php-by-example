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

class settype extends function_core
{
    public $examples = [
        [
            '__var' => "5bar",
            '$var',
            "integer"
        ],
        [
            '__var' => true,
            '$var',
            "string"
        ]
    ];

    public $input_args = '__var';

    public $options_list = ['type' => ['boolean', 'bool', 'integer', 'int', 'float', 'double', 'string', 'array', 'object', 'null']];

    public $source_code = '
        $_var =
            $__var; // mixed $__var

        inject_function_call
    ';

    public $synopsis = 'bool settype ( mixed &$var , string $type )';
}
