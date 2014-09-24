<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * default class used to implement class and object method callbacks, see filter
 */

class callback
{
    static $closures;

    function __construct($closures)
    {
        self::$closures = $closures;
    }

    function __call($name, $arguments)
    {
        return self::__callStatic($name, $arguments);
    }

    static function __callStatic($name, $arguments)
    {
        $closure = isset(self::$closures[$name]) ? self::$closures[$name] : null;

        return call_user_func_array($closure, $arguments);
    }
}
