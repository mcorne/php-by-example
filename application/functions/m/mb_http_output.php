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

class mb_http_output extends function_core
{
    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $synopsis = 'mixed mb_http_output ([ string $encoding = mb_http_output() ] )';
}
