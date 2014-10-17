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

class get_meta_tags extends function_core
{
    public $examples = ["http://www.example.com/"];

    public $no_input_args = 'use_include_path';

    public $synopsis = 'array get_meta_tags ( string $filename [, bool $use_include_path = false ] )';

    function pre_exec_function()
    {
        $filename = $this->_filter->filter_filename('filename');
        $this->_filter->is_allowed_arg_value('use_include_path', false);
    }

    public $test_not_to_run = true;
}
