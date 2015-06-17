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

class locale__getallvariants extends function_core
{
    public $examples = ["sl_IT_NEDIS_ROJAZ_1901"];

    public $synopsis = 'public static array Locale::getAllVariants ( string $locale )';
}
