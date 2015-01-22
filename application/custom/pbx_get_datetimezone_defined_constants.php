<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Returns the list of DateTimeZone constants
 *
 * @return array
 * @throws Exception
*/
function pbx_get_datetimezone_defined_constants()
{
    static $constants;

    if (! isset($constants)) {
        $manual_page_name = __DIR__ . '/class.datetimezone.html';

        if (! file_exists($manual_page_name) or ! $content = file_get_contents($manual_page_name)) {
            throw new Exception("cannot read $manual_page_name");
        }

        if (! preg_match_all('~<code>(DateTimeZone::[A-Z_]+)</code>~', $content, $matches)) {
            throw new Exception("cannot parse $manual_page_name");
        }

        $constants = [];

        foreach ($matches[1] as $constant_name) {
            if (defined($constant_name)) {
                $constants[$constant_name] = constant($constant_name);
            }
        }
    }

    return $constants;
}

/**
 * Provides access to the functions above through class or object methods
 *
 * This class is used for unit testing.
 *
 */
class pbx_get_datetimezone_defined_constants
{
    function __call($name, $arguments)
    {
        return call_user_func_array(self::$name, $arguments);
    }

    static function get_datetimezone_defined_constants()
    {
        return pbx_get_datetimezone_defined_constants();
    }
}
