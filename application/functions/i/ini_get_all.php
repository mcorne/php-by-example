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

class ini_get_all extends function_core
{
    public $hash_result = '~^(arg_separator|bcmath|date|default_charset|highlight|iconv|intl|mbstring|pcre|precision|zlib)~';

    public $examples = [
        "pcre",
        ["pcre", false],
        [null, false]
    ];

    public $options_getter = ['extension' => 'get_loaded_extensions'];

    public $synopsis = 'array ini_get_all ([ string $extension [, bool $details = true ]] )';

    public $test_not_validated = true;
}
