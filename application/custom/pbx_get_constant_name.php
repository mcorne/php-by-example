<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Returns the constant names that match a given value and constant prefix
 *
 * @param type $value
 * @param type $constant_prefix eg "IMAGETYPE"
 * @param boolean $to_string
 * @param string $separator
 * @return array|string|false
 */
function pbx_get_constant_name($value, $constant_prefix, $to_string = false, $separator = ',')
{
    $constants = get_defined_constants();
    $pattern = preg_quote($constant_prefix, '~');

    foreach ($constants as $constant_name => $constant_value) {
        if ($constant_value == $value and preg_match("~$pattern~", $constant_name)) {
            $constant_names[] = $constant_name;
        }
    }

    if (! isset($constant_names)) {
        return false;
    }

    if ($to_string) {
        $constant_names = implode($separator, $constant_names);
    }

    return $constant_names;
}

/**
 * Provides access to the functions above through class or object methods
 *
 * This class is used for unit testing.
 *
 */
class pbx_get_constant_name
{
    function __call($name, $arguments)
    {
        return call_user_func_array(self::$name, $arguments);
    }

    static function get_constant_name($value, $constant_prefix)
    {
        return pbx_get_constant_name($value, $constant_prefix);
    }
}
