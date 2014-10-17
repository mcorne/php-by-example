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

class array_rand extends function_core
{
    public $examples = [
        [
            ["Neo", "Morpheus", "Trinity", "Cypher", "Tank"],
            2
        ],
    ];

    public $synopsis = 'mixed array_rand ( array $array [, int $num = 1 ] )';

    public $test_not_validated = true;
}
