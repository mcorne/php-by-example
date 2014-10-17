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

class time_nanosleep extends function_core
{
    public $examples = [
        [
            0,
            500000000
        ],
        [
            0,
            500000000
        ],
        [
            2,
            100000
        ]
    ];

    public $synopsis = 'mixed time_nanosleep ( int $seconds , int $nanoseconds )';

    public $test_not_to_run = true;
}
