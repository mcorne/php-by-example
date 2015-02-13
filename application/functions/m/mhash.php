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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class mhash extends function_core
{
    public $constant_prefix = ['hash' => 'MHASH'];

    public $examples = [
        [
            'MHASH_MD5',
            'apple',
        ],
        [
            'MHASH_MD5',
            'apple',
            'my special key',
        ]
    ];

    public $source_code = '
        inject_function_call

        // shows the result in hexadecimal
        $hex = bin2hex($string);
    ';

    public $synopsis = 'string mhash ( int $hash , string $data [, string $key ] )';

    function post_exec_function()
    {
        $this->result['hex'] = bin2hex($this->result['string']);
    }
}
