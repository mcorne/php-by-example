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

class ip2long extends function_core
{
    public $examples = ["192.0.34.166"];

    public $source_code = '
        inject_function_call

        // shows the result unsigned
        if ($int < 0) {
            $unsigned = printf("%u", $int);
        }
    ';

    public $synopsis = 'int ip2long ( string $ip_address )';

    public $test_not_validated = true; // result either positive or negative depending on the platform

    function post_exec_function()
    {
        if ($this->result['int'] < 0) {
            $this->result['unsigned'] = sprintf("%u", $this->result['int']);
        }
    }
}
