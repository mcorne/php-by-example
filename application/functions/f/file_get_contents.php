<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/filter.php';
require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class file_get_contents extends function_core
{
    public $examples = [
        [
            filter::DEFAULT_FILENAME,
            NULL,
            NULL,
            6,
            5,
        ],
        [
            'http://www.example.com/',
            false,
            NULL,
            0,
            100,
        ],
        [
            filter::DEFAULT_FILENAME
        ],
        [
            filter::DEFAULT_FILENAME,
            true,
            'xyz',
            6,
            5,
        ],
        // used in translations_in_action.php
        [],
        [
            filter::DEFAULT_FILENAME,
            NULL,
            NULL,
            '_NO_CHANGE_',
            5,
        ],
        [
            filter::DEFAULT_FILENAME,
            NULL,
            '_NO_CHANGE_',
            6,
            5,
        ],
        [
            'http://www.example.com/',
            false,
            NULL,
            0,
            99999,
        ],
        [
            'abc',
        ],
        [
            filter::DEFAULT_FILENAME,
            true,
            NULL,
            6,
            5,
        ],
    ];

    public $no_input_args = 'use_include_path';

    public $source_code = '
        // loads some data in a temp file
        $_filename = tempnam(sys_get_temp_dir(), "pbe");
        file_put_contents($_filename, "Hello world !");

        // reads the file or a url
        inject_function_call

        // removes the temp file
        unlink($_filename);
    ';

    public $synopsis = 'string file_get_contents ( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = -1 [, int $maxlen ]]]] )';

    public $test_not_to_run = 1;

    public $test_not_validated = 8;

    function pre_exec_function()
    {
        $filename = $this->_filter->filter_filename('filename', true);
        $this->_filter->is_allowed_arg_value('use_include_path', false);
        $this->_filter->is_allowed_arg_value('context');
        $this->_filter->filter_file_length('maxlen', $filename);
    }
}
