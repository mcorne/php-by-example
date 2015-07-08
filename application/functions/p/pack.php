<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pack extends function_core
{
    public $examples = [
        [
            "nvc*",
            '_NO_QUOTE_0x1234',
            '_NO_QUOTE_0x5678',
            65,
            66,
        ]
    ];

    public $source_code = '
        inject_function_call

        // shows the result in hexadecimal
        $hex = bin2hex($string);
    ';

    public $synopsis       = 'string pack ( string $format [, mixed $args [, mixed $... ]] )';
    public $synopsis_fixed = 'string pack ( string $format, mixed $args1, mixed $args2, mixed $args3, mixed $args4 [, mixed $args [, mixed $... ]] )';

    function post_exec_function()
    {
        $this->result['hex'] = bin2hex($this->result['string']);
    }
}
