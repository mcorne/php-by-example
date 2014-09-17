<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_filter extends function_core
{
    public $examples = [
        [
            [
                "a" => 1,
                "b" => 2,
                "c" => 3,
                "d" => 4,
                "e" => 5
            ],
            '$odd',
        ],
        [
            [6, 7, 8, 9, 10, 11, 12],
            '$even',
        ],
        [
            [
                0 => 'foo',
                1 => false,
                2 => -1,
                3 => null,
                4 => ''
            ],
        ],
        [
            [
                0 => 'foo',
                1 => false,
                2 => -1,
                3 => null,
                4 => ''
            ],
            'is_numeric'
        ],
        [
            [
                0 => 'foo',
                1 => false,
                2 => -1,
                3 => null,
                4 => ''
            ],
            'ctype_alpha'
        ],
        // used in translations_in_action.php
        [
            [
                "a" => 1,
            ],
            'xyz',
        ],
        [
            [
                "a" => 1,
            ],
            'time',
        ],
    ];

    public $helper_callbacks = ['index_in_example' => 1, 'function_name_pattern' => '~(^ctype_|^is_)~'];

    public $source_code = '
// custom callback functions
$odd  = function($var) { return($var & 1); };
$even = function($var) { return(!($var & 1)); };

inject_function_call
';

    public $synopsis = 'array array_filter ( array $array [, callable $callback ] )';

    function pre_exec_function()
    {
        $this->_filter->filter_callback('callback');
    }
}
