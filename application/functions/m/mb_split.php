<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_convert_case.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mb_split extends mb_convert_case
{
    public $examples = [
        [
            'encoding' => 'UTF-8',
            '[ ,]+',
            'I have, a big car',
        ],
    ];

    public $source_code = '
        mb_internal_encoding("UTF-8");

        inject_function_call
    ';

    public $synopsis = 'array mb_split ( string $pattern , string $string [, int $limit = -1 ] )';
}
