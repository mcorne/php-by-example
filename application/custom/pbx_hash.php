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
function pbx_hash($mixed, $excluded_keys = true)
{
    if (is_array($mixed)) {
        $hash = pbx_hash_array($mixed, $excluded_keys);

    } else if ($mixed === '') {
        // this is an empty string, leaves it empty, this is better when called recursively
        // for a hashed list starting with a separator, eg "/home/..."
        $hash = '';

    } else if (in_array($mixed, [0, 1, '0', '1', false, true], true)) {
        $hash = pbx_hash_boolean($mixed);

    } else if (preg_match('~^(exe|htm|html|ini|log|php|phtml|pxml|sh|sock|text|tmp|xhtml|xml)$~', $mixed)) {
        // this is a file extension, leaves the extension untouched
        $hash = $mixed;

    } else if (is_numeric($mixed)) {
        $hash = pbx_hash_number($mixed);

    } else if (preg_match('~[/\\\\,;:=.]~', $mixed, $separator)) {
        // this is a list of strings, eg a path "/home/john"
        // warning! leave the "." in the list of separators above as the last entry, so a numeric string is pick up as such
        // note that a list with different separators is hashed recursively for each separator, eg getenv("HTTP_ACCEPT")
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
function pbx_hash_array($array, $excluded_keys = true)
{
    $hash = [];

    foreach ($array as $key => $value) {
        if (pbx_is_value_to_hash($key, $excluded_keys)) {
            $value = pbx_hash($value, true);
        };

        $hash[$key] = $value;
    }

    return $hash;
}

/**
 * Hashes a boolean or equivalent into a start
 *
 * @param  mixed $boolean
 * @return mixed
 */
function pbx_hash_boolean($boolean)
{
    return '*';
}

/**
 * Hashes an integer into another integer of the same size
 *
 * @param  int $integer
 * @return int
 */
function pbx_hash_integer($integer)
{
    $hash    = pbx_crc16($integer);
    $decimal = hexdec($hash);
    $decimal = substr($decimal, 0, strlen($integer));

    return $decimal;
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
    $integers = explode('.', $number);
    $decimals = array_map('pbx_hash_integer', $integers);
    $decimal = implode('.', $decimals);

    return $decimal;
}

/**
 * Hashes a string into an ascii string or a similar length
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
    $ascii = substr($ascii, 0, strlen($string));

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
 * Determines if a value is to be hashed depending on the key
 *
 * @param string $key
 * @param mixed $excluded_keys
 * @return bool
 */
function pbx_is_value_to_hash($key, $excluded_keys)
{
    $hash_value = false;

    if ($excluded_keys === true) {
        // the value is to be hashed regardless of the key
        $hash_value = true;

    } else if (! $excluded_keys) {
        // the value is not to be hashed
        $hash_value = false;

    } else if (is_array($excluded_keys)) {
        // the value is to be hashed id the key is not in the list of excluded keys
        $hash_value = ! in_array($key, $excluded_keys);

    } else if (preg_match('~^([^a-z \\\\]).+\1$~', $excluded_keys)) {
        // the value is to hashed if keu does not match the pattern of excluded keys
        $hash_value = ! preg_match($excluded_keys, $key);

    } else {
        // the key is to hashed if the key is not the excluded key
        $hash_value = $key != $excluded_keys;
    }

    return $hash_value;
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

    static function hash($mixed, $excluded_keys = true)
    {
        return pbx_hash($mixed, $excluded_keys);
    }

    static function hash_array($array, $excluded_keys = true)
    {
        return pbx_hash_array($array, $excluded_keys);
    }

    static function hash_boolean($boolean)
    {
        return pbx_hash_boolean($boolean);
    }

    static function hash_integer($integer)
    {
        return pbx_hash_integer($integer);
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

    static function is_value_to_hash($key, $excluded_keys)
    {
        return pbx_is_value_to_hash($key, $excluded_keys);
    }
}