<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom/pbx_hash.php';

class posix_getpwnam extends function_core
{
    public $examples = [
        null, // placeholder, see below
        "tom",
    ];

    public $source_code = '
        inject_function_call

        // note that the result is hashed with pbx_hash_array() for security
    ';

    public $synopsis = 'array posix_getpwnam ( string $username )';

    public $test_not_validated = true;

    function init()
    {
        // gets the current user name, hashes the user name, sets the hash in the first example
        $this->examples[0] = pbx_hash_string(get_current_user());
    }

    function post_exec_function()
    {
        if ($array = $this->result['array']) {
            if ($this->result['array']['name'] == get_current_user()) {
                // this is the current user name, hashes the result
                $this->result['array'] = pbx_hash_array($array);
            } else {
                // another user name was passed, hashes the result except the user name for consistency
                $this->result['array'] = pbx_hash_array($array, 'name');
            }
        }
    }

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('username') == $this->examples[0]) {
            // this is the hashed current user name, gets the actual user name to pass to the function
            $this->returned_params['username'] = get_current_user();
        }
    }
}
