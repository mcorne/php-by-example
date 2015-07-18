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

 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class exif_read_data extends function_core
{
    public $examples = [
        [
            '/tmp/flower.jpg',
            'IFD0',
        ],
        [
            '/tmp/flower.jpg',
            'COMMENT',
        ],
        [
            '/tmp/legs.jpg',
            'THUMBNAIL',
        ],
    ];

    public $options_list = ['sections' => ['ANY_TAG', 'COMMENT', 'COMPUTED', 'EXIF', 'FILE', 'IFD0', 'THUMBNAIL']];

    public $synopsis = 'array exif_read_data ( string $filename [, string $sections = NULL [, bool $arrays = false [, bool $thumbnail = false ]]] )';

    public $test_not_validated = [0, 2]; // cannot validate because of returned FileDateTime that changes

    function pre_exec_function()
    {
        $this->copy_file_to_temp('flower.jpg');
        $this->copy_file_to_temp('legs.jpg');
    }
}
