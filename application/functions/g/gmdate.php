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

class gmdate extends function_core
{
    public $constant_prefix = ['format' => 'DATE'];

    public $examples = [
        ["M d Y H:i:s", 946684800]
    ];

    public $synopsis = 'string gmdate ( string $format [, int $timestamp = time() ] )';
}
