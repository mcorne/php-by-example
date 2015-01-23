<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class timezone_name_from_abbr extends function_core
{
    public $examples = [
        "CET",
        [
            "",
            3600,
            0
        ]
    ];

    public $synopsis = 'string timezone_name_from_abbr ( string $abbr [, int $gmtOffset = -1 [, int $isdst = -1 ]] )';

    function _get_options_list()
    {
        $constants = timezone_abbreviations_list();
        $constants = array_keys($constants);
        $constants = array_diff($constants, range('a', 'z')); // removes one letter time zones
        $constants = array_map('strtoupper', $constants);
        $options_list = ['abbr' => $constants];

        return $options_list;
    }
}
