<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * on-the-fly oject instantiation
 * getter management
 *
 * this class is meant to be extended by all classes
 */

class object
{
    public static $config;
    public static $objects;

    function __construct($config = null)
    {
        if ($config) {
            self::$config = $config;
        }

        $class = get_class($this);
        self::$objects[$class] = $this;
    }

    function __get($name)
    {
        if ($name[0] == '_') {
            // this is the name of an object as it is prefixed with "_", eg "_parser", gets or creates the object
            $this->$name = $this->get_object($name);

        } else if (isset(self::$config[$name])) {
            // this is a config entry, creates a shorcut to the config entry, eg $this->application_path
            $this->$name = self::$config[$name];

        } else {
            // this is a property of the object, gets the property
            $this->$name = $this->get_property($name);
        }

        return $this->$name;
    }

    function create_object($classname, $directory = null, $object_name = null)
    {
        if (! $directory) {
            // defaults to the "models" directory
            $directory = 'models';
        }

        require_once "$directory/$classname.php";
        $object = new $classname();

        if ($object_name) {
            self::$objects[$object_name] = $object;
        }

        return $object;
    }

    function get_object($name)
    {
        // the class name is meant to be the same as the object name without the "_" prefix, eg "parser", removes the "_" prefix
        $classname = substr($name, 1);

        if (! isset(self::$objects[$classname])) {
            $this->create_object($classname);
        }

        return self::$objects[$classname];
    }

    function get_property($name)
    {
        $get_method = "_get_$name";

        if (method_exists($this, $get_method)) {
            // there is a getter method to get the property, gets the property
            $property = $this->$get_method();

        } else if (method_exists($this, '_get')) {
            // there is a getter method for the class, gets the property
            $property = $this->_get($name);

        } else {
            $property = null;
        }

        return $property;
    }

    function reset_dynamic_properties()
    {
        $object_properties = array_keys(get_object_vars($this));
        $fixed_properties = array_keys(get_class_vars(get_class($this)));
        $dynamic_properties = array_diff($object_properties, $fixed_properties);

        foreach ($dynamic_properties as $property) {
            unset($this->$property);
        }
    }
}
