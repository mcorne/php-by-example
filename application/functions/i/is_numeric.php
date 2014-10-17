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

class is_numeric extends function_core
{
    public $examples = [
        "42",
        1337,
        '_NO_QUOTE_0x539',
        '_NO_QUOTE_02471',
        '_NO_QUOTE_0b10100111001',
        '_NO_QUOTE_1337e0',
        "not numeric",
        [[]],
        9.1,
    ];

    public $synopsis = 'bool is_numeric ( mixed $var )';
}
