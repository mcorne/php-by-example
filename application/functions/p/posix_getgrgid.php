<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class posix_getgrgid extends function_core
{
    public $examples = [
        null, // placeholder, see below
        10000,
    ];

    public $synopsis = 'array posix_getgrgid ( int $gid )';

    public $test_not_validated = true;

    function init()
    {
        // gets the current group id, hashes the group id, sets the hash in the first example
        $this->examples[0] = $this->hash(getmygid());
    }

    function post_exec_function()
    {
        if ($array = $this->result['array']) {
            if ($this->result['array']['gid'] == getmygid()) {
                // this is the current group id, hashes the result
                $this->result['array'] = $this->hash($array);
            } else {
                // another group id was passed, hashes the result except the group id for consistency
                $this->result['array'] = $this->hash($array, 'gid');
            }
        }
    }

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('gid') == $this->examples[0]) {
            // this is the hashed current group id, gets the actual group id to pass to the function
            $this->returned_params['gid'] = getmygid();
        }
    }
}
