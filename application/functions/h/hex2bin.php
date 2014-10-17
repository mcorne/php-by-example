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

class hex2bin extends function_core
{
    public $examples = ["6578616d706c65206865782064617461"];

    public $synopsis = 'string hex2bin ( string $data )';
}
