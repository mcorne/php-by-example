<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

require_once 'custom-functions/pbx_hash.php';

class getmyuid extends function_core
{
    public $source_code = '
        inject_function_call

        // shows the user information
        if ($int !== false and function_exists("posix_getpwuid")) {
            $array = posix_getpwuid($int);
        }

        // note that the result is hashed with pbx_hash_number() and pbx_hash_array() for security
    ';

    public $synopsis = 'int getmyuid ( void )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        $int = $this->result['int'];

        if ($int === false) {
            return;
        }

        $this->result['int'] = pbx_hash_number($int);

        if (function_exists('posix_getpwuid') and $array = posix_getpwuid($int)) {
            $this->result['array'] = pbx_hash_array($array);
        }
    }
}
