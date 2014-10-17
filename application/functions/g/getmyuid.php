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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class getmyuid extends function_core
{
    public $source_code = '
        inject_function_call

        // shows the user information
        if ($int !== false and function_exists("posix_getpwuid")) {
            $array = posix_getpwuid($int);
        }
    ';

    public $synopsis = 'int getmyuid ( void )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        $int = $this->result['int'];

        if ($int === false) {
            return;
        }

        $this->result['int'] = $this->hash($int);

        if (function_exists('posix_getpwuid') and $array = posix_getpwuid($int)) {
            $this->result['array'] = $this->hash($array);
        }
    }
}
