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

class echo_ extends function_core
{
    public $examples = [
        ['Hello World'],
        ['Hello', ' World'],
        [[123, 456]],
        [],
    ];

    public $method_to_exec = 'echo_construct';

    public $output_buffer = true;

    public $synopsis       = 'void echo ( string $arg1 [, string $... ] )';
    public $synopsis_fixed = 'void echo ( string $arg1, string $arg2 [, string $... ] )';
}

function echo_construct($arg1 = '_ARG_MISSING_', $arg2 = null)
{
    if ($arg1 == '_ARG_MISSING_') {
        throw new Exception("Parse error: syntax error, unexpected ')'", E_ERROR);
    }

    echo $arg1, $arg2;
}
