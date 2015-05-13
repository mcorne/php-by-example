<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Converts a base 64 string to an hexadecimal string
 *
 * @param  string $string
 * @param  string $to_hex_notation
 * @return string
 */
function pbx_base64_to_hex($base64, $to_hex_notation = false)
{
    $binary = base64_decode($base64);
    $hexadecimal = bin2hex($binary);

    if ($to_hex_notation) {
        $splitted = str_split($hexadecimal, 2);
        $hexadecimal = '\x' . implode('\\x', $splitted);
    }

    return $hexadecimal;
}

/**
 * Provides access to the functions above through class or object methods
 *
 * This class is used for unit testing.
 *
 */
class pbx_base64_to_hex
{
    function __call($name, $arguments)
    {
        return call_user_func_array(self::$name, $arguments);
    }

    static function base64_to_hex($string, $to_hex_notation = false)
    {
        return pbx_base64_to_hex($string, $to_hex_notation);
    }
}
