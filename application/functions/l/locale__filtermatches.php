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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class locale__filtermatches extends function_core
{
    public $examples = [
        [
            "de-DEVA",
            "de-DE",
            false
        ],
        [
            "de-DE-1996",
            "de-DE",
            false
        ]
    ];

    public $synopsis = 'public static bool Locale::filterMatches ( string $langtag , string $locale [, bool $canonicalize = false ] )';
}
