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

class chr extends function_core
{
    public $examples = [
        48,
        '_NO_QUOTE_0x30',
        '_NO_QUOTE_060',
        '_NO_QUOTE_0b110000',
    ];

    public $synopsis = 'string chr ( int $ascii )';
}
