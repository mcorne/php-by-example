<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'file_exists.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class fileatime extends file_exists
{
    public $examples = [__FILE__, "/path/to/foo.txt"];

    public $source_code = '
        date_default_timezone_set("UTC");

        inject_function_call

        // shows the date in a readable format
        if ($int) {
            $date = date("Y-m-d H:i:s", $int);
        }
    ';

    public $synopsis = 'int fileatime ( string $filename )';

    function post_exec_function()
    {
        if ($this->result['int']) {
            $this->result['date'] = date("Y-m-d H:i:s", $this->result['int']);
        }
    }

    function pre_exec_function()
    {
        date_default_timezone_set("UTC");
    }
}
