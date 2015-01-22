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

class datetimezone__listidentifiers extends function_core
{
    public $examples = [
        [
            'DateTimeZone::AFRICA',
        ],
        [
            'DateTimeZone::PER_COUNTRY',
            'FR',
        ],
    ];

    public $constant_prefix = ['what' => 'DateTimeZone::'];

    public $synopsis = 'public static array DateTimeZone::listIdentifiers ([ int $what = DateTimeZone::ALL [, string $country = NULL ]] )';
}
