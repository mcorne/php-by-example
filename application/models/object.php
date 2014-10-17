<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
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

    public $dependant_objects = [];

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
            // this is the name of an object as it is prefixed with "_", eg "_parser", see get_object_name(), gets or creates the object
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
        foreach ($this->dependant_objects as $class_name) {
            if (isset(self::$objects[$class_name])) {
                $this->create_object($class_name);
            }
        }
    }

    function create_object($class_name, $directory = null, $alias = null, $fixed_classname = null)
    {
        $this->load_class($class_name, $directory);

        if ($fixed_classname) {
            $class_name = $fixed_classname;
        }

        $object = new $class_name();

        if ($alias) {
            $object->set_alias_object($alias);
        }

        return $object;
    }

    function get_class_name($object_name)
    {
        // the class name is meant to be the same as the object name without the "_" prefix, eg "parser", removes the "_" prefix
        $class_name = substr($object_name, 1);

        return $class_name;
    }

    function &get_object($object_name)
    {
        $class_name = $this->get_class_name($object_name);

        if (! isset(self::$objects[$class_name])) {
            $this->create_object($class_name);
        }

        return self::$objects[$class_name];
    }

    function get_object_name($class_name)
    {
        // the object name is meant to be the same as the class name with the "_" prefix, eg "_parser", adds the "_" prefix
        $object_name = "_$class_name";

        return $object_name;
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

    function load_class($class_name, $directory = null)
    {
        if (class_exists($class_name, false)) {
            return;
        }

        if (! $directory) {
            // defaults to the "models" directory
            $directory = 'models';
        }

        require_once "$directory/$class_name.php";
    }

    function register_object()
    {
        $class_name = get_class($this);
        self::$objects[$class_name] = $this;
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
        $class_name = get_class($this);
        unset(self::$objects[$class_name]);
    }
}
