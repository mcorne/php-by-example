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
 * @see docs/function-configuration.txt
 */

class imagecreate extends function_core
{
    public $examples = [
        [
            200,
            100,
        ],
    ];

    public $synopsis = 'resource imagecreate ( int $width , int $height )';

    function post_exec_function()
    {
        if ($this->result['resource']) {
            $this->image_path = $this->_file->write_public_temp_image($this->result['resource']);
        }
    }
}
