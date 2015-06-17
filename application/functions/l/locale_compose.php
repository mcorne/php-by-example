<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'locale__composelocale.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class locale_compose extends locale__composelocale
{
    public $manual_function_name = 'Locale::composeLocale';

    public $synopsis = 'string locale_compose ( array $subtags )';
}
