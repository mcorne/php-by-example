<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

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
