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

class imagearc extends function_core
{
    public $examples = [
        [
            'image_width'  => 200,
            'image_height' => 100,
            'red'          => 0,
            'green'        => 255,
            'blue'         => 0,
            '$image',
            100,
            50,
            120,
            80,
            30,
            290,
            '$color',
        ],
    ];

    public $input_args = ['image_width', 'image_height', 'red', 'green', 'blue'];

    public $source_code = '
        $_image = imagecreatetruecolor (
            $image_width, // int $image_width
            $image_height // int $image_height
        );

        $_color = imagecolorallocate(
            $_image,
            $red, // int $red,
            $green, // int $green,
            $blue // int $blue
        );

        inject_function_call
    ';

    public $synopsis = 'bool imagearc ( resource $image , int $cx , int $cy , int $width , int $height , int $start , int $end , int $color )';

    function post_exec_function()
    {
        if ($this->result['image']) {
            $this->image_path = $this->_file->write_public_temp_image($this->result['image']);
        }
    }

    function pre_exec_function()
    {
        $image_width  = $this->_filter->filter_arg_value('image_width');
        $image_height = $this->_filter->filter_arg_value('image_height');

        if (! $this->result['image'] = $this->returned_params['image'] = imagecreatetruecolor($image_width, $image_height)) {
            $this->method_to_exec = false;
            return;
        }

        $red   = $this->_filter->filter_arg_value('red');
        $green = $this->_filter->filter_arg_value('green');
        $blue  = $this->_filter->filter_arg_value('blue');

        if (! $this->result['color'] = $this->returned_params['color'] = imagecolorallocate($this->returned_params['image'], $red, $green, $blue)) {
            $this->method_to_exec = false;
            return;
        }

    }
}
