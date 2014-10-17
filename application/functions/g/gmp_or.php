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

class gmp_or extends function_core
{
    public $examples = [
        ["0xfffffff2", "4"],
        ["0xfffffff2", "2"]
    ];

    public $source_code = '
        inject_function_call

        // shows the result
        $string = gmp_strval($resource, 16);
    ';

    public $synopsis = 'resource gmp_or ( resource $a , resource $b )';

    function post_exec_function()
    {
        $this->result['string'] = gmp_strval($this->result['resource'], 16);
    }
}
