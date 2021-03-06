<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class parse_ini_string extends function_core
{
    public $examples = [
        [
            '[first_section]
            one = 1
            five = 5
            animal = BIRD

            [second_section]
            path = "/usr/local/bin"
            URL = "http://www.example.com/~username"

            [third_section]
            phpversion[] = "5.0"
            phpversion[] = "5.1"
            phpversion[] = "5.2"
            phpversion[] = "5.3"'
        ],
        [
            '[first_section]
            one = 1
            five = 5
            animal = BIRD

            [second_section]
            path = "/usr/local/bin"
            URL = "http://www.example.com/~username"

            [third_section]
            phpversion[] = "5.0"
            phpversion[] = "5.1"
            phpversion[] = "5.2"
            phpversion[] = "5.3"',
            true
        ],
    ];

    public $synopsis = 'array parse_ini_string ( string $ini [, bool $process_sections = false [, int $scanner_mode = INI_SCANNER_NORMAL ]] )';
}
