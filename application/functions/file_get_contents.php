<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/filter.php';

class file_get_contents extends function_core
{
    public $source_code = '
$_filename = tempnam(sys_get_temp_dir(), "pbe");
file_put_contents($_filename, "Hello world !");
inject_function_call
unlink($_filename);
';

    public $examples = [
        [
            filter::DEFAULT_FILE_NAME,
            NULL,
            NULL,
            6,
            5,
        ],
        [
            'http://www.example.com/'
        ],
    ];

    public $no_input_args = 'use_include_path';

    public $synopsis = 'string file_get_contents ( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = -1 [, int $maxlen ]]]] )';

    function pre_exec_function()
    {
        $this->_filter->filter_filename('filename');
        $this->_filter->filter_use_include_path('use_include_path');
        $this->_filter->filter_context('context');
    }
}
