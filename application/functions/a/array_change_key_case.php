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

class array_change_key_case extends function_core
{
    public $examples = [
        [
            [
                "FirSt" => 1,
                "SecOnd" => 4
            ],
            'CASE_UPPER',
        ]
    ];

    public $synopsis = 'array array_change_key_case ( array $array [, int $case = CASE_LOWER ] )';
}
