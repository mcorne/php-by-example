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

class posix_getpwuid extends function_core
{
    public $examples = [
        null, // placeholder, see below
        10000,
    ];

    public $synopsis = 'array posix_getpwuid ( int $uid )';

    public $test_not_validated = true;

    function init()
    {
        // gets the current user id, hashes the user id, sets the hash in the first example
        $this->examples[0] = $this->hash(getmyuid());
    }

    function post_exec_function()
    {
        if ($array = $this->result['array']) {
            if ($this->result['array']['uid'] == getmyuid()) {
                // this is the current user id, hashes the result
                $this->result['array'] = $this->hash($array);
            } else {
                // another user id was passed, hashes the result except the user id for consistency
                $this->result['array'] = $this->hash($array, 'uid');
            }
        }
    }

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('uid') == $this->examples[0]) {
            // this is the hashed current user id, gets the actual user id to pass to the function
            $this->returned_params['uid'] = getmyuid();
        }
    }
}
