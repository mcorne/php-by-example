<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom/pbx_get_constant_name.php';
require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class exif_imagetype extends function_core
{
    public $examples = [
        [
            "https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/Political_World_Map_in_Official_Language.jpg/320px-Political_World_Map_in_Official_Language.jpg",
        ],
    ];

    public $source_code = '
        inject_function_call

        // displays the constant name
        $name = pbx_get_constant_name($int, "IMAGETYPE", true);
    ';

    public $synopsis = 'int exif_imagetype ( string $filename )';

    public $test_not_to_run = true;

    function post_exec_function()
    {
        if (isset($this->result['int'])) {
            $this->result['name'] = pbx_get_constant_name($this->result['int'], 'IMAGETYPE', true);
        }
    }
}
