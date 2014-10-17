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
 * @see docs/function-configuration.txt
 */

class array_splice extends function_core
{
    public $examples = [
        [
            '__input' => ["red", "green", "blue", "yellow"],
            '$input',
            2
        ],
        [
            '__input' => ["red", "green", "blue", "yellow"],
            '$input',
            1,
            -1
        ],
        [
            '__input' => ["red", "green", "blue", "yellow"],
            '$input',
            1,
            4,
            "orange"
        ],
        [
            '__input' => ["red", "green", "blue", "yellow"],
            '$input',
            -1,
            1,
            ["black", "maroon"]
        ],
        [
            '__input' => ["red", "green", "blue", "yellow"],
            '$input',
            3,
            0,
            "purple"
        ],
    ];

    public $input_args = '__input';

    public $source_code = '
        $_input =
            $__input; // array $__input;

        inject_function_call
    ';

    public $synopsis = 'array array_splice ( array &$input , int $offset [, int $length [, mixed $replacement = array() ]] )';
}
