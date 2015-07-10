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

class exif_thumbnail extends function_core
{
    public $examples = [
        [
            '/tmp/legs.jpg',
            '$width',
            '$height',
            '$imagetype',
        ],
        [
            '/tmp/flower.jpg',
        ],
    ];

    public $synopsis = 'string exif_thumbnail ( string $filename [, int &$width [, int &$height [, int &$imagetype ]]] )';

    function post_exec_function()
    {
        if ($this->result['string']) {
            $this->image_path = $this->_file->write_public_temp_file($this->result['string']);
        }
    }
}
