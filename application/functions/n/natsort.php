<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class natsort extends function_core
{
    public $source_code = '
$_array =
    $__array; // array $__array
inject_function_call
';

    public $examples = [
        [
            '__array' => ["img12.png", "img10.png", "img2.png", "img1.png"],
            '$array',
        ],
        [
            '__array' => ['-5','3','-2','0','-1000','9','1'],
            '$array',
        ],
        [
            '__array' => ['09', '8', '10', '009', '011', '0'],
            '$array',
        ],
        [
            '__array' => ['image_1.jpg','image_12.jpg', 'image_21.jpg', 'image_4.jpg'],
            '$array',
        ],
        [
            '__array' => ['orange' => 1, 'apple' => 1, 'yogurt' => 4, 'banana' => 4],
            '$array',
        ],
    ];

    public $input_args = '__array';

    public $synopsis = 'bool natsort ( array &$array )';

    function pre_exec_function()
    {
        $this->returned_params['array'] = $this->_filter->filter_param('__array');
    }
}
