<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

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
