<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
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

class print_r extends function_core
{
    public $examples = [
        [
            [
                "a" => "apple",
                "b" => "banana",
                "c" => [
                    0 => "x",
                    1 => "y",
                    2 => "z",
                ],
            ],
            true
        ],
        [
            [
                "m" => "monkey",
                "foo" => "bar",
                "x" => [
                    0 => "x",
                    1 => "y",
                    2 => "z",
                ],
            ],
            true
        ],
        // used in translations_in_action.php
        [
            [
                "a" => "apple",
            ],
        ],
    ];

    public $synopsis = 'mixed print_r ( mixed $expression [, bool $return = false ] )';

    function pre_exec_function()
    {
        $this->_filter->is_allowed_arg_value('return', true, false);
    }
}
