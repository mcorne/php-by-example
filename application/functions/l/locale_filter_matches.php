<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'locale__filtermatches.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class locale_filter_matches extends locale__filtermatches
{
    public $manual_function_name = 'Locale::filterMatches';

    public $synopsis = 'bool locale_filter_matches ( string $langtag , string $locale [, bool $canonicalize = false ] )';
}
