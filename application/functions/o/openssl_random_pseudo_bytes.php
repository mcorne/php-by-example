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

class openssl_random_pseudo_bytes extends function_core
{
    public $examples = [
        [4 , '$crypto_strong'],
        [1 , '$crypto_strong'],
        [0 , '$crypto_strong'],
        [-1, '$crypto_strong'],
    ];

    public $source_code = '
        inject_function_call

        // shows the result in hexadecimal
        if ($string) {
            $hex = bin2hex($string);
        }
    ';

    public $synopsis = 'string openssl_random_pseudo_bytes ( int $length [, bool &$crypto_strong ] )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        if ($string = $this->result['string']) {
            $this->result['hex'] = bin2hex($string);
        }
    }
}
