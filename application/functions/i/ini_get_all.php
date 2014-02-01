<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class ini_get_all extends function_core
{
    public $examples = [
        "pcre",
        ["pcre", 'false'],
        ['null', 'false']
    ];

    public $synopsis = 'array ini_get_all ([ string $extension [, bool $details = true ]] )';

    public $test_always_valid = true;
}
