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

class posix_getpwnam extends function_core
{
    public $examples = [
        null, // placeholder, see below
        "tom",
    ];

    public $synopsis = 'array posix_getpwnam ( string $username )';

    public $test_not_validated = true;

    function init()
    {
        // gets the current user name, hashes the user name, sets the hash in the first example
        $this->examples[0] = $this->hash(get_current_user());
    }

    function post_exec_function()
    {
        if ($array = $this->result['array']) {
            if ($this->result['array']['name'] == get_current_user()) {
                // this is the current user name, hashes the result
                $this->result['array'] = $this->hash($array);
            } else {
                // another user name was passed, hashes the result except the user name for consistency
                $this->result['array'] = $this->hash($array, 'name');
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
