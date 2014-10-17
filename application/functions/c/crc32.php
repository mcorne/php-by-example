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

class crc32 extends function_core
{
    public $examples = ["The quick brown fox jumped over the lazy dog."];

    public $synopsis = 'int crc32 ( string $str )';
}
