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

class utf8_encode extends function_core
{
    public $examples = [
        '_DOUBLE_QUOTES_\xE0_DOUBLE_QUOTES_',
    ];

    public $synopsis = 'string utf8_encode ( string $data )';
}
