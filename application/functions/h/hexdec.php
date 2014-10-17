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

class hexdec extends function_core
{
    public $examples = ["See", "ee", "that", "a0"];

    public $synopsis = 'number hexdec ( string $hex_string )';
}
