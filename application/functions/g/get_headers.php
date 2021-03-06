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

class get_headers extends function_core
{
    public $examples = [
        "http://www.example.com",
        ["http://www.example.com", 1],
    ];

    public $options_range = ['format' => [0, 1]];

    public $synopsis = 'array get_headers ( string $url [, int $format = 0 ] )';

    public $test_not_to_run = true;
}
