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

class realpath_cache_get extends function_core
{
    public $synopsis = 'array realpath_cache_get ( void )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        if ($array = $this->result['array']) {
            $keys   = $this->hash(array_keys($array));
            $values = $this->hash(array_values($array));
            $this->result['array'] = array_combine($keys, $values);
        }
    }
}
