<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class get_meta_tags extends function_core
{
    public $examples = ["http://www.example.com/"];

    public $no_input_args = 'use_include_path';

    public $synopsis = 'array get_meta_tags ( string $filename [, bool $use_include_path = false ] )';

    function pre_exec_function()
    {
        $filename = $this->_filter->filter_filename('filename');
        $this->_filter->filter_allowed_value('use_include_path', false);
    }

    public $test_not_to_run = true;
}
