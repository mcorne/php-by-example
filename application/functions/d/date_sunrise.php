<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'date_sun_info.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class date_sunrise extends date_sun_info
{
    // see http://en.wikipedia.org/wiki/Twilight or http://aa.usno.navy.mil/faq/docs/RST_defs.php
    // comments must be aligned for displaying purposes
    public $commented_options = [
        'zenith' => [
            [90, '     horizon'],
            [90.8333, 'sunrise or sunset'],
            [96, '     civil twilight'],
            [102, '    nautical twilight'],
            [108, '    astronomical twilight'],
        ]
    ];

    public $examples = [
        [
            'timezone' => "Europe/Paris",
            'time' => "now",
            'city' => 'Paris',
            '$timestamp',
            'SUNFUNCS_RET_STRING',
            '$latitude',
            '$longitude',
        ],
        [
            'time' => "2014-12-20 12:00",
            '$timestamp',
            'SUNFUNCS_RET_STRING',
            38.72, // Lisbon, Portugal
            -9.13,
            90,
            1
        ],
    ];

    public $options_range = ['gmt_offset' => [-12, 12]];

    public $source_code = '
        // select a $_timezone or enter $_gmt_offset
        // enter a $_time or a $_timestamp
        // select a $_city or enter the $_latitude and $_longitude

        // gets a timestamp from a date
        date_default_timezone_set(
            $timezone // string $timezone
        );
        $_timestamp = strtotime(
            $time // string $time
        );

        // gets the latitude and longitude of a city
        list($_latitude, $_longitude) = pbx_get_city_lat_lng(
            $city // string $city
        );

        inject_function_call
    ';

    public $test_not_validated = [0];

    public $synopsis       = 'mixed date_sunrise ( int $timestamp [, int $format = SUNFUNCS_RET_STRING [, float $latitude = ini_get(&quot;date.default_latitude&quot;) [, float $longitude = ini_get(&quot;date.default_longitude&quot;) [, float $zenith = ini_get(&quot;date.sunrise_zenith&quot;) [, float $gmt_offset = 0 ]]]]] )';
    public $synopsis_fixed = null;

    function post_exec_function()
    {
        if ($this->returned_params) {
            $this->result = $this->returned_params + $this->result;
        }
    }
}
