<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * function input params extraction
 */

class function_params extends object
{
    function _get_params()
    {
        if ($_POST) {
            // the function input form is submitted
            $params = $_POST;

        } else {
            if (isset($_GET['example'])) {
                // an example number is passed in the url, extracts the example number minus 1
                // note that "the displayed example number" = "the example property number" + 1
                $example_id = $_GET['example'] - 1;

            } else if (! is_null($this->test_example_id)) {
                // an example number is passed in a property, uses the example number
                // this mechanism is used when testing functions
                $example_id = $this->test_example_id;

            } else {
                $example_id = null;
            }

            $params = $this->_examples->get_example($example_id);
        }

        return $params;
    }

    function get_param($param_name, $indirect_get_param_from_var = true)
    {
        if (! $this->param_exists($param_name)) {
            return null;
        }

        $value = trim($this->params[$param_name]);

        if (strlen($value) > 1000) {
            $message = $this->_message_translation->translate('the argument was truncated to 1000 bytes in this example', '$' . $param_name);
            trigger_error($message, E_USER_NOTICE);
        }

        $value = $this->_parser->parse_value($value, $param_name);

        if ($indirect_get_param_from_var and $this->is_param_var($value)) {
            // the param values is actually a variable name, gets the value of that variable
            // eg "$handle" returned by fopen() and used by fread($handle, ...)
            $value = $this->get_param_var($value, $param_name);
        }

        return $value;
    }

    function get_param_var($value, $param_name)
    {
        $var_name = $this->get_var_name($value);

        if (isset($this->returned_params[$var_name])) {
            // the variable has a (returned) value linked to the var name itself,
            // eg the resource "handle" linked to the param name "handle" in fread()
            $value =  $this->returned_params[$var_name];

        } else  if (isset($this->returned_params[$param_name])) {
            // the variable has a (returned) value linked to the param name,
            // eg the closure "$odd" linked to param name "callback" in array_filter()
            $value =  $this->returned_params[$param_name];

        } else  if (isset($this->params["__$var_name"])) {
            // the variable is set from another (pseudo) variable invisible to the user, prefixed with "__",
            // eg "$__array" linked to param name "$array" in sort()
            $value =  $this->get_param("__$var_name");

        } else  if ($var_name == $param_name) {
            // the param value is the same as the param name, eg $param['match'] = '$match'
            // this is typically the case for an arg passed by reference
            $value = null;

        } else {
            $value = null;
        }

        return $value;
    }

    function get_var_name($value)
    {
        // extracts the var name, eg "array" from "$array"
        $var_name = substr($value, 1);

        return $var_name;
    }

    function is_param_var($value)
    {
        // checks if the value matches the PHP pattern of a var name
        // see http://fr2.php.net/manual/en/language.variables.basics.php
        $is_var = (is_string($value) and preg_match('~^\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)$~', $value));

        return $is_var;
    }

    function param_exists($param_name)
    {
        // checks if a param value is different from an empty string which means something was passed
        $exists = (array_key_exists($param_name, $this->params) and trim($this->params[$param_name]) !== '');

        return $exists;
    }
}