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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class gmp_abs extends function_core
{
    public $examples = ["274982683358", "-274982683358"];

    public $source_code = '
        inject_function_call

        // shows the result
        $string = gmp_strval($resource);
    ';

    public $synopsis = 'resource gmp_abs ( resource $a )';

    function post_exec_function()
    {
        $this->result['string'] = gmp_strval($this->result['resource']);
    }
}
