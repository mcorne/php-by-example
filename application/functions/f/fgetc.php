<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
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

class fgetc extends function_core
{
    public $examples = [
        [
            'data'    => 'Hello !',
            '__count' => 4,
            'handle'  => '$handle',
        ],
        [
            'data'    => 'Hello !',
            '__count' => 10,
            'handle'  => '$handle',
        ],
        [
            'data'    => 'Hello !',
            '__count' => 0,
            'handle'  => 123,
        ],
    ];

    public $input_args = ['__count', 'data'];

    public $source_code = '
        // loads some data in a temp file
        file_put_contents(
            "/tmp/pbe.txt",
            $data // mixed $data
        );

        $count =
            $__count; // int $__count

        $_handle = fopen("/tmp/pbe.txt", "r");

        for ($i = 0; $i < $count; $i++) {
            _NO_BOLD_%s($_handle);
        }

        inject_function_call
    ';

    public $synopsis = 'string fgetc ( resource $handle )';

    function init()
    {
        $this->source_code = sprintf($this->source_code, get_class($this));
    }

    function pre_exec_function()
    {
        if (! $filename = tempnam(sys_get_temp_dir(), "pbe")) {
            throw new Exception('cannot get temp file name');
        }

        $data = $this->_filter->filter_arg_value('data');

        if (@file_put_contents($filename, $data) === false) {
            throw new Exception("cannot create $filename");
        }

        if (! $handle = @fopen($filename, 'r')) {
            throw new Exception("cannot open $filename");
        }

        $count = $this->_filter->filter_iteration_count('__count');

        if ($this->_filter->filter_arg_value('handle', false) != '$handle') {
            // an invalid handle is passed, sets the handle to this value
            $handle = $this->_filter->filter_arg_value('handle');
        }

        $function_name = $this->_synopsis->function_name;

        for ($i = 0; $i < $count; $i++) {
            $function_name($handle);
        }

        $this->returned_params['handle'] = $handle;
    }
}
