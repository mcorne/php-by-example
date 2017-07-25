<?php
/**
 * PHP By Example
 *
 * @copyright 2017 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mime_content_type extends function_core
{
    public $examples = ['/tmp/flower.jpg', '/tmp/test.php'];

    public $synopsis = 'string mime_content_type ( string $filename )';

    function pre_exec_function()
    {
        $this->copy_file_to_temp('flower.jpg');
        $this->copy_file_to_temp('test.php');
    }
}
