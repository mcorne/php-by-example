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

class array_pop extends function_core
{
    public $examples = [
        [
            '__array' => ["orange", "banana", "apple", "raspberry"],
            '$array',
        ],
    ];

    public $input_args = '__array';

    public $source_code = '
        $_array =
            $__array; // array $__array

        inject_function_call
    ';

    public $synopsis = 'mixed array_pop ( array &$array )';
}
