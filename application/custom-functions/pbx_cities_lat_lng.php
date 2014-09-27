<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Converts a latitude or longitude to a signed float
 *
 * @param string $coordinate eg "51°29′N", or "0°00′E/W"
 * @return float
 */
function pbx_coordinate_to_float($coordinate)
{
    if (! preg_match("~^(\d+)°(\d+)'([NESW])~", $coordinate, $match)) {
        return null;
    }

    list(, $degrees, $minutes, $direction) = $match;
    $coordinate = round($degrees + $minutes / 60, 2);

    if ($direction == 'S' or $direction == 'W') {
        $coordinate = -$coordinate;
    }

    return $coordinate;
}

/**
 * Returns the latitude and longitude of a city
 *
 * @param string $city eg "Aberdeen, United Kingdom, Scotland", or "Aberdeen, United Kingdom", or "Aberdeen"
 * @return array latitude and longitude, or null for both
 */
function pbx_get_city_lat_lng($city)
{
    $pieces = preg_split('~[,;:/+| ]+~', $city, -1, PREG_SPLIT_NO_EMPTY);
    $indexed_lat_lng = pbx_index_lat_lng();

    if (isset($pieces[2])) {
        list($city, $country, $state) = $pieces;
        $lat_lng = isset($indexed_lat_lng[$city][$country][$state]) ? current($indexed_lat_lng[$city][$country][$state]) : null;

    } else if (isset($pieces[1])) {
        list($city, $country) = $pieces;
        $lat_lng = isset($indexed_lat_lng[$city][$country]) ? current($indexed_lat_lng[$city][$country]) : null;

    } else if (isset($pieces[0])) {
        list($city) = $pieces;
        $lat_lng = isset($indexed_lat_lng[$city]) ? current($indexed_lat_lng[$city]) : null;

    } else {
        $lat_lng = null;
    }

    return $lat_lng ?: [null, null];
}

/**
 * Returns the list of major cities
 *
 * @return array
 */
function pbx_get_city_names()
{
    static $city_names;

    if (! isset($city_names)) {
        $cities_lat_lng = pbx_load_cities_lat_lng();

        foreach ($cities_lat_lng as $city_lat_lng) {
            list($city, $country, $state) = explode("\t", $city_lat_lng);
            $city_name = "$city, $country";

            if ($state) {
                $city_name .= ", $state";
            }
            $city_names[] = $city_name;
        }
    }

    return $city_names;
}
/**
 * Indexes the latitudes and longitudes by city
 *
 * @return array
 */
function pbx_index_lat_lng()
{
    static $indexed_lat_lng;

    if (! isset($indexed_lat_lng)) {
        $cities_lat_lng = pbx_load_cities_lat_lng();

        foreach ($cities_lat_lng as $city_lat_lng) {
            list($city, $country, $state, $latitude, $longitude) = explode("\t", $city_lat_lng);

            $lat_lng = [
                pbx_coordinate_to_float($latitude),
                pbx_coordinate_to_float($longitude),
            ];

            $indexed_lat_lng[$city][] = $lat_lng;
            $indexed_lat_lng[$city][$country][] = $lat_lng;

            if ($state) {
                $indexed_lat_lng[$city][$country][$state][] = $lat_lng;
            }
        }
    }

    return $indexed_lat_lng;
}

/**
 * Loads the latitudes and longitudes of the major cities
 *
 * @return array
 * @see https://code.google.com/p/php-by-example/source/browse/trunk/application/custom-functions/cities-lat-lng.csv
 * @see http://en.wikipedia.org/wiki/List_of_cities_by_longitude#Sources
 */
function pbx_load_cities_lat_lng()
{
    static $cities_lat_lng;

    if (! isset($cities_lat_lng)) {
        $cities_lat_lng = file(__DIR__ . '/cities-lat-lng.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        // skips the column headers
        array_shift($cities_lat_lng);
    }
    return $cities_lat_lng;
}
