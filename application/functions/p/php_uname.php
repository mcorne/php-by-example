<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class php_uname extends function_core
{
    public $options_list = ['mode' => ['a', 'm', 'n', 'r', 's', 'v']];

    public $synopsis = 'string php_uname ([ string $mode = &quot;a&quot; ] )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        if (! $string = $this->result['string']) {
            return;
        }

        $mode = $this->_filter->filter_arg_value('mode');

        if (in_array($mode, ['s', 'm'])) {
            // the system name and machine type may be disclosed

        } else if (in_array($mode, ['n', 'r', 'v'])) {
            // the host, version and release names are hashed for security
            $string = $this->hash($string);

        } else {
            // note that invalid modes default to "a"
            $string = [
                php_uname('s') ,
                $this->hash(php_uname('n')) ,
                $this->hash(php_uname('r')) ,
                $this->hash(php_uname('v')) ,
                php_uname('m') ,
            ];

            $string = implode(' ', $string);
        }

        $this->result['string'] = $string;
    }
}
