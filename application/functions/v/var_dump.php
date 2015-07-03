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

class var_dump extends function_core
{
    public $examples = [
        [
            [
                0 => 1,
                1 => 2,
                2 => [
                    0 => "a",
                    1 => "b",
                    2 => "c",
                ],
            ]
        ],
        [
            3.1,
            true,
        ],
    ];

    public $source_code = '
        ob_start();

        inject_function_call

        $contents = ob_get_contents();
        ob_end_clean();
    ';

    public $synopsis       = 'void var_dump ( mixed $expression [, mixed $... ] )';
    public $synopsis_fixed = 'void var_dump ( mixed $expression, mixed $expression2 [, mixed $... ] )';

    function post_exec_function()
    {
        $this->result['contents'] = ob_get_contents();
        ob_end_clean();
    }

    function pre_exec_function()
    {
        ob_start();

        if (ini_get('xdebug.overload_var_dump')) {
            ini_set('xdebug.overload_var_dump', false);
        }
    }
}
