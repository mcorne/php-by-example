<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/filter.php';

class fread extends function_core
{
    public $source_code = '
$_filename = tempnam(sys_get_temp_dir(), "pbe");
file_put_contents($_filename, "Hello world !");
$_mode =
    $mode; // string $mode
$_handle = fopen(
    $filename, // string $filename
    "$mode");
inject_function_call
fclose($_handle);
unlink($_filename);
';

    public $examples = [
        [
            'filename' => filter::DEFAULT_FILE_NAME,
            'mode'     => 'rb',
            '$handle',
            5,
        ],
        [
            'filename' => 'http://www.example.com/',
            'mode'     => 'rb',
            '$handle',
            100,
        ],
        [
            'filename' => 'http://www.xyz.com/',
            'mode'     => 'r',
            '$handle',
            100000,
        ],
        [
            'filename' => filter::DEFAULT_FILE_NAME,
            'mode'     => 'rb',
            '$handle',
        ],
    ];

    public $input_args = 'filename';

    public $synopsis = 'string fread ( resource $handle , int $length )';

    public $test_not_to_run = [1, 2];

    function post_exec_function()
    {
        fclose($this->returned_params['handle']);
    }

    function pre_exec_function()
    {
        $filename = $this->_filter->filter_filename('filename', true);
        $mode = $this->_filter->filter_arg_value('mode');
        $this->returned_params['handle'] = fopen($filename, $mode);

        if ($this->_function_params->get_param('length')) {
            $this->_filter->filter_file_length('length', $filename);
        }
        // else: the length is empty which is caught by the function itself
    }
}
