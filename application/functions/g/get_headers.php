<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class get_headers extends function_core
{
    public $examples = [
        "http://www.example.com",
        ["http://www.example.com", 1],
    ];

    public $synopsis = 'array get_headers ( string $url [, int $format = 0 ] )';

    public $test_always_valid = true;
}
