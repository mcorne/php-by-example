<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Filters the imported variables with a list of names or a prefix
 *
 * @param array  $defined_vars typically the result of get_defined_vars()
 *                             eg ["color" => "blue", "size" => "medium", "shape" => "sphere"]
 * @param array  $var_names    the list of variable names to filter
 *                             eg ["color", "size"]
 * @param string $prefix       a variable prefix, typically added by extract(), to which "_" is appended
 *                             eg "my" to filter "my_color"
 * @return array
 */

function pbx_filter_imported_vars($defined_vars, $var_names = null, $prefix = null)
{
    $imported_vars = [];

    if (isset($var_names)) {
        $imported_vars += pbx_filter_imported_vars_by_names($defined_vars, $var_names);
    }

    if (isset($prefix)) {
        $imported_vars += pbx_filter_imported_vars_with_prefix($defined_vars, $prefix);
    }

    return $imported_vars;
}

/**
 * Filters the imported variables with a list of names
 *
 * @param array $defined_vars
 * @param array $var_names
 * @return array
 */
function pbx_filter_imported_vars_by_names($defined_vars, $var_names)
{
    $imported_vars = [];

    foreach ($var_names as $var_name) {
        if (isset($defined_vars[$var_name])) {
            $imported_vars[$var_name] = $defined_vars[$var_name];
        }
    }

    return $imported_vars;
}

/**
 * Filters the imported variables with a prefix
 *
 * @param array  $defined_vars
 * @param string $prefix
 * @return array
 */
function pbx_filter_imported_vars_with_prefix($defined_vars, $prefix)
{
    $prefix .= '_';
    $imported_vars = [];

    foreach ($defined_vars as $var_name => $value) {
        if (strpos($var_name, $prefix) === 0) {
            $imported_vars[$var_name] = $value;
        }
    }

    return $imported_vars;
}

/**
 * Provides access to the functions above through class or object methods
 *
 * This class is used for unit testing.
 *
 */
class pbx_filter_imported_vars
{
    function __call($name, $arguments)
    {
        return call_user_func_array(self::$name, $arguments);
    }

    static function filter_imported_vars($defined_vars, $var_names = null, $prefix = null)
    {
        return pbx_filter_imported_vars($defined_vars, $var_names, $prefix);
    }

    static function filter_imported_vars_by_names($defined_vars, $var_names)
    {
        return pbx_filter_imported_vars_by_names($defined_vars, $var_names);
    }

    static function filter_imported_vars_with_prefix($defined_vars, $prefix)
    {
        return pbx_filter_imported_vars_with_prefix($defined_vars, $prefix);
    }
}
