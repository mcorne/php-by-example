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

class gmp_xor extends function_core
{
    public $examples = [
        ["0b1101101110011101", "0b0110011001011001"],
    ];

    public $source_code = '
        inject_function_call

        // shows the result
        $string = gmp_strval($resource, 2);
    ';

    public $synopsis = 'resource gmp_xor ( resource $a , resource $b )';

    function post_exec_function()
    {
        $this->result['string'] = gmp_strval($this->result['resource'], 2);
    }
}
