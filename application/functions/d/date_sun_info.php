<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

require_once 'custom-functions/pbx_cities_lat_lng.php';

class date_sun_info extends function_core
{
    public $examples = [
        [
            'timezone' => "Europe/Paris",
            'time' => "now",
            'city' => 'Paris',
            '$timestamp',
            '$latitude',
            '$longitude',
        ],
        [
            'timezone' => "UTC",
            'time' => "2006-12-12",
            '$timestamp',
            31.7667,
            35.2333,
        ],
        [
            'timezone' => "UTC",
            962409600,
            50,
            50,
        ],
    ];

    public $input_args = ['timezone'];

    public $options_getter = [
        'city'     => 'pbx_get_city_names',
        'timezone' => ['DateTimeZone', 'listIdentifiers'],
    ];

    public $source_code = '
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

        // shows the times in a readable format
        $date_sun_info = array_map(
            function($_timestamp) { return date("H:i:s", $_timestamp); },
            $_array);
    ';

    public $synopsis       = 'array date_sun_info ( int $time , float $latitude , float $longitude )';
    public $synopsis_fixed = 'array date_sun_info ( int $timestamp , float $latitude , float $longitude )';

    public $test_not_validated = [0];

    function post_exec_function()
    {
        if ($this->returned_params) {
            $this->result = $this->returned_params + $this->result;
        }

        if ($this->result['array']) {
            $this->result['date_sun_info'] = array_map(
                function($timestamp) { return date("H:i:s", $timestamp); },
                $this->result['array']);
        }
    }

    function pre_exec_function()
    {
        if ($timezone = $this->_filter->filter_arg_value('timezone')) {
            date_default_timezone_set($timezone);
        }

        if ($time = $this->_filter->filter_arg_value('time')) {
            $this->returned_params['timestamp'] = strtotime($time);
        }

        if ($city = $this->_filter->filter_arg_value('city')) {
            list($latitude, $longitude) = pbx_get_city_lat_lng($city);
            $this->returned_params['latitude']  = $latitude;
            $this->returned_params['longitude'] = $longitude;
        }
    }
}
