<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom/pbx_get_two_letter_country_codes.php';
require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class datetimezone__listidentifiers extends function_core
{
    public $commented_options_getter = ['country' => 'pbx_get_two_letter_country_codes'];

    public $constant_prefix = ['what' => 'DateTimeZone::'];

    public $examples = [
        [
            'DateTimeZone::AFRICA',
        ],
        [
            'DateTimeZone::PER_COUNTRY',
            'FR',
        ],
    ];

    public $synopsis = 'public static array DateTimeZone::listIdentifiers ([ int $what = DateTimeZone::ALL [, string $country = NULL ]] )';
}
