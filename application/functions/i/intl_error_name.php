<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class intl_error_name extends function_core
{
    public $constant_prefix = ['error_code' => 'U'];

    public $examples = ["U_USING_FALLBACK_WARNING"];

    public $synopsis = 'string intl_error_name ( int $error_code )';
}
