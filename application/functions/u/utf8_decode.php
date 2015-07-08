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

class utf8_decode extends function_core
{
    public $examples = [
        'à',
    ];

    public $source_code = '
        inject_function_call

        // shows the result in hexadecimal
        $hex = bin2hex($string);
    ';

    public $synopsis = 'string utf8_decode ( string $data )';

    function post_exec_function()
    {
        $this->result['hex'] = bin2hex($this->result['string']);
    }
}
