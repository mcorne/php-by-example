<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Returns the list of classes constants
 *
 * @return array
 * @throws Exception
*/
function pbx_get_classes_defined_constants()
{
    static $constants = [];

    if (! $constants) {
        $pattern = __DIR__ . '/class_constants/*.html';

        if (! $manual_page_names = glob(__DIR__ . '/class_constants/*.html')) {
            throw new Exception("cannot glob: $pattern");
        }

        foreach ($manual_page_names as $manual_page_name) {
            $constants += pbx_get_class_defined_constants($manual_page_name);
        }

        ksort($constants);
    }

    return $constants;
}

/**
 * Returns the list of a class constants
 *
 * @param string $manual_page_name
 * @return array
 * @throws Exception
 */
function pbx_get_class_defined_constants($manual_page_name)
{
    if (! $content = file_get_contents($manual_page_name)) {
        throw new Exception("cannot read: $manual_page_name");
    }

    if (! preg_match_all('~<code>([A-Za-z]+::[A-Z_]+)</code>~', $content, $matches)) {
        throw new Exception("cannot parse: $manual_page_name");
    }

    $constants = [];

    foreach ($matches[1] as $constant_name) {
        if (defined($constant_name)) {
            $constants[$constant_name] = constant($constant_name);
        }
    }

    return $constants;
}

/**
 * Returns the constant names that match a given value and class prefix
 *
 * @param type $value
 * @param type $class_prefix eg "Collator", "Collator::SORT"
 * @param boolean $to_string
 * @param string $separator
 * @return array|string|false
 */
function pbx_get_class_constant_name($value, $class_prefix, $to_string = false, $separator = ',')
{
    $constants = pbx_get_classes_defined_constants();
    $pattern = preg_quote($class_prefix, '~');

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
class pbx_get_classes_defined_constants
{
    function __call($name, $arguments)
    {
        return call_user_func_array(self::$name, $arguments);
    }

    static function get_classes_defined_constants()
    {
        return pbx_get_classes_defined_constants();
    }

    static function get_class_defined_constants()
    {
        return pbx_get_class_defined_constants();
    }

    static function get_class_constant_name($value, $class_prefix)
    {
        return pbx_get_class_constant_name($value, $class_prefix);
    }
}
