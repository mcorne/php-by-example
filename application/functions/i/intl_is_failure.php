<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'intl_error_name.php';

class intl_is_failure extends intl_error_name
{
    public $examples = ["U_ZERO_ERROR", "U_USING_FALLBACK_WARNING", "U_ILLEGAL_ARGUMENT_ERROR"];

    public $synopsis = 'bool intl_is_failure ( int $error_code )';
}
