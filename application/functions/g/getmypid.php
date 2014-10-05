<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom-functions/pbx_hash.php';

class getmypid extends function_core
{
    public $source_code = '
        inject_function_call

        // note that the result is hashed with pbx_hash_number() for security
    ';

    public $synopsis = 'int getmypid ( void )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        if ($int = $this->result['int']) {
            $this->result['int'] = pbx_hash_number($int);
        }
    }
}
