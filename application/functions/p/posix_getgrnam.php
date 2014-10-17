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

class posix_getgrnam extends function_core
{
    public $examples = [
        null, // placeholder, see below
        "toons",
    ];

    public $synopsis = 'array posix_getgrnam ( string $name )';

    public $test_not_validated = true;

    function _get_current_group()
    {
        $gid = getmygid();

        if ($gid !== false and function_exists('posix_getgrnam') and $array = posix_getgrgid($gid)) {
            $current_group = $array['name'];
        } else {
            $current_group = null;
        }

        return $current_group;
    }

    function init()
    {
        // gets the current group name, hashes the group name, sets the hash in the first example
        $this->examples[0] = $this->hash($this->current_group);
    }

    function post_exec_function()
    {
        if ($array = $this->result['array']) {
            if ($this->result['array']['name'] == $this->current_group) {
                // this is the current group name, hashes the result
                $this->result['array'] = $this->hash($array);
            } else {
                // another group name was passed, hashes the result except the group name for consistency
                $this->result['array'] = $this->hash($array, 'name');
            }
        }
    }

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('name') == $this->examples[0]) {
            // this is the hashed current group name, gets the actual group name to pass to the function
            $this->returned_params['name'] = $this->current_group;
        }
    }
}
