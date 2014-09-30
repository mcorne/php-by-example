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

        $this->register_object();
    }

    function __get($name)
    {
        if ($name[0] == '_') {
            // this is the name of an object as it is prefixed with "_", eg "_parser", gets or creates the object
            $this->$name = &$this->get_object($name);

        } else if (isset(self::$config[$name])) {
            // this is a config entry, creates a shorcut to the config entry, eg $this->application_path
            $this->$name = self::$config[$name];

        } else {
            // this is a property of the object, gets the property
            $this->$name = $this->get_property($name);
        }

        return $this->$name;
    }

    function create_dependant_objects()
    {
        foreach ($this->dependants as $classname) {
            if (isset(self::$objects[$classname])) {
                $this->create_object($classname);
            }
        }
    }

    function create_object($classname, $directory = null, $alias = null, $fixed_classname = null)
    {
        if (! $directory) {
            // defaults to the "models" directory
            $directory = 'models';
        }

        require_once "$directory/$classname.php";

        if ($fixed_classname) {
            $classname = $fixed_classname;
        }

        $object = new $classname();

        if ($alias) {
            $object->set_alias_object($alias);
        }

        return $object;
    }

    function &get_object($object_name)
    {
        // the class name is meant to be the same as the object name without the "_" prefix, eg "parser", removes the "_" prefix
        $classname = substr($object_name, 1);

        if (! isset(self::$objects[$classname])) {
            $this->create_object($classname);
        }

        return self::$objects[$classname];
    }

    function get_property($property_name)
    {
        $get_method = "_get_$property_name";

        if (method_exists($this, $get_method)) {
            // there is a getter method to get the property, gets the property
            $property = $this->$get_method();

        } else if (method_exists($this, '_get')) {
            // there is a getter method for the class, gets the property
            $property = $this->_get($property_name);

        } else {
            $property = null;
        }

        return $property;
    }

    function register_object()
    {
        $classname = get_class($this);
        self::$objects[$classname] = $this;
    }

    function set_alias_object($alias)
    {
        if (isset(self::$objects[$alias])) {
            $previous_object = self::$objects[$alias];
            $previous_object->unregister_object();
        }

        $this->create_dependant_objects();
        self::$objects[$alias] = $this;
    }

    function unregister_object()
    {
        $classname = get_class($this);
        unset(self::$objects[$classname]);
    }
}
