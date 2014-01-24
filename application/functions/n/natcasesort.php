<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class natcasesort extends function_core
{
    public $source_code = '
$_array =
    $__array; // array $__array
inject_function_call
';

    public $examples = [
        [
            '__array' => ['IMG0.png', 'img12.png', 'img10.png', 'img2.png', 'img1.png', 'IMG3.png'],
            '$array',
        ],
    ];

    public $input_args = '__array';

    public $synopsis = 'bool natcasesort ( array &$array )';

    function pre_exec_function()
    {
        $this->returned_params['array'] = $this->_filter->filter_param('__array');
    }
}
