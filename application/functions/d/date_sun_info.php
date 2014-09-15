<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class date_sun_info extends function_core
{
    public $examples = [
        [
            'timezone' => "Europe/Paris",
            'time' => "now",
            'city' => '48.85, 2.35', // Paris
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

    public $options_getter = ['timezone' => ['DateTimeZone', 'listIdentifiers']];

    public $source_code = '
// gets a timestamp from a date
date_default_timezone_set(
    $timezone // string $timezone
);
$_timestamp = strtotime(
    $time // string $time
);

// gets the latitude and longitude of a city
list($_latitude, $_longitude) = @explode(", " ,
    $city // string $city
);

inject_function_call

// enter a $_time or a $_timestamp
// select a $_city or enter the $_latitude and $_longitude

// shows the times in a readable format
$date_sun_info = array_map(
    function($_timestamp) { return date("H:i:s", $_timestamp); },
    $_array);

';

    public $synopsis       = 'array date_sun_info ( int $time , float $latitude , float $longitude )';
    public $synopsis_fixed = 'array date_sun_info ( int $timestamp , float $latitude , float $longitude )';

    public $test_not_validated = [0];

    function _get_options_list()
    {
        $cities_lat_lng = $this->_file->read_csv_lines($this->application_path . '/data/cities-lat-lng.csv');

        foreach ($cities_lat_lng as $city_lat_lgn) {
            list($city, $country, $state, $latitude, $longitude) = $city_lat_lgn;
            $latitude  = $this->parse_coordinate($latitude);
            $longitude = $this->parse_coordinate($longitude);

            if ($latitude !== null and $longitude !== null) {
                $value = "\"$latitude, $longitude\"";
                $text = "$city, $country";

                if ($state) {
                    $text .= "/$state";
                }

                $options[$value] = $text;
            }
        }

        $options_list = isset($options) ? ['city' => $options] : [];

        return $options_list;
    }

    function parse_coordinate($coordinate)
    {
        // eg "51°29′N", "0°00′E/W"
        if (! preg_match("~^(\d+)°(\d+)′([NESW])~", $coordinate, $match)) {
            return null;
        }

        list(, $degrees, $minutes, $direction) = $match;
        $coordinate = round($degrees + $minutes / 60, 2);

        if ($direction == 'S' or $direction == 'W') {
            $coordinate = -$coordinate;
        }

        return $coordinate;
    }

    function post_exec_function()
    {
        $this->result['date_sun_info'] = array_map(
            function($timestamp) { return date("H:i:s", $timestamp); },
            $this->result['array']);
    }

    function pre_exec_function()
    {
        $timezone = $this->_filter->filter_arg_value('timezone');
        date_default_timezone_set($timezone);

        if ($time = $this->_filter->filter_arg_value('time')) {
            $this->returned_params['timestamp'] = strtotime($time);
        }

        if ($city = $this->_filter->filter_arg_value('city')) {
            list($this->returned_params['latitude'], $this->returned_params['longitude']) = @explode(", " , $city);
        }
    }
}
