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

class iconv_set_encoding extends function_core
{
    public $examples = [
        ["internal_encoding", "UTF-8"],
        ["output_encoding", "UTF-8"]
    ];

    public $options_getter = ['charset'  => 'mb_list_encodings'];

    public $options_list = ['type' => ['input_encoding', 'output_encoding', 'internal_encoding']];

    public $source_code = '
        inject_function_call

        // shows the new encoding
        $mixed = iconv_get_encoding();
    ';

    public $synopsis = 'bool iconv_set_encoding ( string $type , string $charset )';

    function post_exec_function()
    {
        $this->result['mixed'] = iconv_get_encoding();
    }
}
