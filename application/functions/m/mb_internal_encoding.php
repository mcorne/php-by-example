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

class mb_internal_encoding extends function_core
{
    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $examples = [[], "UTF-8"];

    public $synopsis = 'mixed mb_internal_encoding ([ string $encoding = mb_internal_encoding() ] )';
}
