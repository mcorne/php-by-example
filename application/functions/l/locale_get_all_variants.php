<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'locale__getallvariants.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class locale_get_all_variants extends locale__getallvariants
{
    public $manual_function_name = 'Locale::getAllVariants';

    public $synopsis = 'array locale_get_all_variants ( string $locale )';
}
