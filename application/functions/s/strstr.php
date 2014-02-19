<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class strstr extends function_core
{
    public $examples = [
        [
            "name@example.com",
            "@"
        ],
        [
            "name@example.com",
            "@",
            true
        ]
    ];

    public $synopsis = 'string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )';
}
