<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 * @see
 */

require_once 'pbx_crc16.php';

/**
 * Hashes data
 *
 * @param  mixed $mixed
 * @param  array $excluded_keys
 * @return mixed
 */
function pbx_hash($mixed, $excluded_keys = null)
{
    if (is_array($mixed)) {
        $hash = pbx_hash_array($mixed, $excluded_keys);

    } else if (is_numeric($mixed)) {
        $hash = pbx_hash_number($mixed);

    } else if (preg_match('~[/,;]~', $mixed, $separator)) {
        $hash = pbx_hash_list($mixed, current($separator));

    } else if (is_string($mixed)) {
        $hash = pbx_hash_string($mixed);

    } else {
        $hash = null;
    }

    return $hash;
}

/**
 * Hashes the entries of an array
 *
 * @param  array $array
 * @param  array $excluded_keys
 * @return array
 */
function pbx_hash_array($array, $excluded_keys = null)
{
    foreach ($array as $key => &$value) {
        if (! in_array($key, (array) $excluded_keys)) {
            $value = pbx_hash($value, $excluded_keys);
        }
    }

    return $array;
}

/**
 * Hashes a list of separated strings or numbers
 *
 * @param  string $list
 * @param  string $separator
 * @return string
 */
function pbx_hash_list($list, $separator)
{
    $strings = explode($separator, $list);
    $hashes  = array_map('pbx_hash', $strings);
    $hash    = implode($separator, $hashes);

    return $hash;
}

/**
 * Hashes a number into another number
 *
 * @param  number $number
 * @return int
 */
function pbx_hash_number($number)
{
    $hash    = pbx_crc16($number);
    $decimal = hexdec($hash);

    return $decimal;
}

/**
 * Hashes a string into an ascii string
 *
 * @param  string $string
 * @return string
 */
function pbx_hash_string($string)
{
    if (! $string) {
        return '';
    }

    $hash  = pbx_crc16($string);
    $ascii = pbx_hash_to_ascii($hash);

    return $ascii;
}

/**
 * Converts a crc16 hash to ascii letters
 *
 * @param  string $hash
 * @return string
 */
function pbx_hash_to_ascii($hash)
{
    // list of consonnants excluding {m, n, s, z}
    static $consonants = ['0' => 'b' , '1' => 'c' , '2' => 'd' , '3' => 'f' , '4' => 'g' , '5' => 'h' , '6' => 'j' , '7' => 'k',
                           '8' => 'l' , '9' => 'p' , 'a' => 'q' , 'b' => 'r' , 'c' => 't' , 'd' => 'v' , 'e' => 'w' , 'f' => 'x'];

    // list of vowels + {m, n, s, z}
    static $vowels     = ['0' => 'am', '1' => 'en', '2' => 'is', '3' => 'oz', '4' => 'um', '5' => 'yn', '6' => 'as', '7' => 'ez',
                          '8' => 'im', '9' => 'on', 'a' => 'us', 'b' => 'yz', 'c' => 'am', 'd' => 'en', 'e' => 'is', 'f' => 'oz'];

    $ascii  = $consonants[$hash[0]];
    $ascii .= $vowels[$hash[1]];
    $ascii .= $consonants[$hash[2]];
    $ascii .= $vowels[$hash[3]];

    return $ascii;
}

/**
 * Provides access to the functions above through class or object methods
 *
 * This class is used for unit testing.
 *
 */
class pbx_hash
{
    function __call($name, $arguments)
    {
        return call_user_func_array(self::$name, $arguments);
    }

    static function hash($mixed, $excluded_keys = null)
    {
        return pbx_hash($mixed, $excluded_keys);
    }

    static function hash_array($array, $excluded_keys = null)
    {
        return pbx_hash_array($array, $excluded_keys);
    }

    static function hash_list($list, $separator)
    {
        return pbx_hash_list($list, $separator);
    }

    static function hash_number($number)
    {
        return pbx_hash_number($number);
    }

    static function hash_string($string)
    {
        return pbx_hash_string($string);
    }

    static function hash_to_ascii($hash)
    {
        return pbx_hash_to_ascii($hash);
    }
}