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

class mcrypt_create_iv extends function_core
{
    public $options_list = ['size' => [8, 16, 32]];

    public $examples = [8];

    public $source_code = '
        inject_function_call

        // shows the result in hexadecimal
        $hex = bin2hex($string);
    ';

    public $synopsis = 'string mcrypt_create_iv ( int $size [, int $source = MCRYPT_DEV_URANDOM ] )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        $this->result['hex'] = bin2hex($this->result['string']);
    }
}
