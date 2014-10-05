<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom-functions/pbx_hash.php';

class posix_getpwuid extends function_core
{
    public $examples = [
        null, // placeholder, see below
        10000,
    ];

    public $source_code = '
        inject_function_call

        // note that the result is hashed with pbx_hash_array() for security
    ';

    public $synopsis = 'array posix_getpwuid ( int $uid )';

    public $test_not_validated = true;

    function __construct($config = null)
    {
        parent::__construct($config);

        // gets the current user id, hashes the user id, sets the hash in the first example
        $this->examples[0] = pbx_hash_number(getmyuid());
    }

    function post_exec_function()
    {
        if ($array = $this->result['array']) {
            if ($this->result['array']['uid'] == getmyuid()) {
                // this is the current user id, hashes the result
                $this->result['array'] = pbx_hash_array($array);
            } else {
                // another user id was passed, hashes the result except the user id for consistency
                $this->result['array'] = pbx_hash_array($array, 'uid');
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
