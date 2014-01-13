<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class object
{
    public $_parent;

    function __construct($mixed = null)
    {
        if ($mixed instanceof self) {
            $this->_parent = $mixed;

        } else if (is_array($mixed)) {
            $this->set_properties($mixed);

        } else if (! is_null($mixed)) {
            throw new Exception('invalid type of data passed to constructor: ' . gettype($mixed));
        }
    }

    function __get($name)
    {
        if ($is_local_property = $this->is_local_property($name)) {
            // this is a local property, removes the "_" suffix
            $name = substr($name, 0, -1);
        }

        if ($name[0] == '_') {
            // this is the name of an object as it is prefixed with "_", eg "_parser", gets or cretes the object
            $this->$name = $this->get_object($name, $is_local_property);

        } else {
            // this is a property, gets the property
            $this->$name = $this->get_property($name, $is_local_property);
        }

        return $this->$name;
    }

    function create_object($classname, $directory = null, array $mixed = null)
    {
        if (is_null($directory)) {
            // defaults the directory to "models"
            $directory = 'models';
        }

        require_once "$directory/$classname.php";

        if (is_null($mixed)) {
            // uses the current object as the parent of the new object
            $mixed = $this;

        } else if (is_array($mixed)) {
            // merges the parents' properties if any into the current properties, eg "(array) $this" was passed
            $mixed = $this->merge_parents_properties($mixed);
        }

        $object = new $classname($mixed);

        return $object;
    }

    function get_object($name, $is_local_object)
    {
        if (! $is_local_object and $this->_parent) {
            // this is not a local object and the current object has a parent
            // links the property to the parent's object, note that the parent will create the object as needed
            $object = $this->_parent->$name;

        } else {
            // the class name is meant to be the same as the object name without the "_" prefix, eg "parser", removes the "_" prefix
            $classname = substr($name, 1);

            if ($is_local_object) {
                // this is a local object, creates the object and passes the current object properties
                $object = $this->create_object($classname, null, (array) $this);

            } else {
                $object = $this->create_object($classname);
            }
        }

        return $object;
    }

    function get_property($name, $is_local_property)
    {
        $get_method = "_get_$name";

        if (method_exists($this, $get_method)) {
            // there is a getter method to get the property, gets the property
            $property = $this->$get_method();

        } else if (! $is_local_property and $this->_parent) {
            // this is not a local property and the current object has a parent
            // gets (a copy of) the parent's property, note that the parent will get the property as needed
            // as a side note it is not possible to get a reference to the parent's property such as: $property =& $this->_parent->$name;
            // which fails and triggers the notice: "Indirect modification of overloaded property sort::$params has no effect"
            $property = $this->_parent->$name;

        } else {
            $property = null;
        }

        return $property;
    }

    function is_local_property($name)
    {
        // a local property is suffixed with "_", eg "_parser_"
        $is_local_property = substr($name, -1) == '_';

        return $is_local_property;
    }

    function merge_parents_properties($properties)
    {
        while (isset($properties['_parent'])) {
            $parent_properties = (array) $properties['_parent'];
            unset($properties['_parent']);
            $properties += $parent_properties;
        }

        return $properties;
    }

    function set_properties($properties)
    {
        foreach ((array) $properties as $key => $value) {
            $this->$key = $value;
        }
    }
}
