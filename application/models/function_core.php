<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

/**
 * all functions must extend this class
 */
class function_core extends action
{
    public $errors;
    public $returned_params;

    /**
     * the error handler
     */
    function add_error($errno , $message)
    {
        $this->errors[] = ['code' => $errno, 'message' => $message];
    }

    function function_exists()
    {
        $parts = explode('::', $this->_synopsis->function_name);

        if (isset($parts[1])) {
            // this is a class, extracts the class and method name
            list($classname, $method_name) = $parts;

            if (! class_exists($classname, false)) {
                $message = $this->_translation->translate('this class is not available in the PHP version running on this server');
                throw new Exception($message);
            }

            if (! method_exists($classname, $method_name)) {
                $message = $this->_translation->translate('this method is not available in the PHP version running on this server');
                throw new Exception($message);
            }

        } else if (! function_exists($this->_synopsis->function_name)) {
            $message = $this->_translation->translate('this function is not available in the PHP version running on this server');
            throw new Exception($message);
        }
    }

    function exec_function()
    {
        $result = [];
        $values = [];

        for ($arg_number = 0; $arg_number <= 9; $arg_number++) {
            if (! isset($this->_synopsis->arg_names[$arg_number]) or ! $this->_params->param_exists($this->_synopsis->arg_names[$arg_number])) {
                // there is no more args passed to the function
                $function = $this->_synopsis->method_name;
                // resets the remaining args that the user might have not reset in the function form
                $this->reset_unused_params($arg_number);

                if (isset($this->object)) {
                    $return = $this->exec_method($function, $arg_number, $values);

                } else {
                    $return = $this->exec_procedure($function, $arg_number, $values);
                }

                if ($this->_synopsis->return_var) {
                    // this function returns a value, sets a "return var" with the return value
                    // this var is used for result displaying purposes
                    $result[$this->_synopsis->return_var] = $return;
                }

                return $result;
            }

            $this->set_arg_value($arg_number, $values, $result);
        }

        throw new Exception('too many parameters passed');
    }

    function exec_method($method, $arg_number, $v)
    {
        $object = $this->object;

        switch ($arg_number) {
            case 0: $return = $object->$method(); break;
            case 1: $return = $object->$method($v[0]); break;
            case 2: $return = $object->$method($v[0], $v[1]); break;
            case 3: $return = $object->$method($v[0], $v[1], $v[2]); break;
            case 4: $return = $object->$method($v[0], $v[1], $v[2], $v[3]); break;
            case 5: $return = $object->$method($v[0], $v[1], $v[2], $v[3], $v[4]); break;
            case 6: $return = $object->$method($v[0], $v[1], $v[2], $v[3], $v[4], $v[5]); break;
            case 7: $return = $object->$method($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6]); break;
            case 8: $return = $object->$method($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6], $v[7]); break;
            case 9: $return = $object->$method($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6], $v[7], $v[8]); break;
            case 10:$return = $object->$method($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6], $v[7], $v[8], $v[9]); break;
            default:
                throw new Exception("invalid arg number: $arg_number");
        }

        return $return;
    }

    function exec_procedure($procedure, $arg_number, $v)
    {
        switch ($arg_number) {
            case 0: $return = $procedure(); break;
            case 1: $return = $procedure($v[0]); break;
            case 2: $return = $procedure($v[0], $v[1]); break;
            case 3: $return = $procedure($v[0], $v[1], $v[2]); break;
            case 4: $return = $procedure($v[0], $v[1], $v[2], $v[3]); break;
            case 5: $return = $procedure($v[0], $v[1], $v[2], $v[3], $v[4]); break;
            case 6: $return = $procedure($v[0], $v[1], $v[2], $v[3], $v[4], $v[5]); break;
            case 7: $return = $procedure($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6]); break;
            case 8: $return = $procedure($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6], $v[7]); break;
            case 9: $return = $procedure($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6], $v[7], $v[8]); break;
            case 10:$return = $procedure($v[0], $v[1], $v[2], $v[3], $v[4], $v[5], $v[6], $v[7], $v[8], $v[9]); break;
            default:
                throw new Exception("invalid arg number: $arg_number");
        }

        return $return;
    }

    function get_example_callbacks($callback_index)
    {
        $example_callbacks = [];

        foreach ($this->examples as $example) {
            if (isset($example[$callback_index]) and $example[$callback_index]) {
                $callback = $example[$callback_index];

                if ($callback[0] != '$') {
                    $callback = "'$callback'";
                }

                $example_callbacks[] = $callback;
            }
        }

        return $example_callbacks;
    }

    function get_defined_callbacks($defined_functions_pattern)
    {
        $defined_functions = get_defined_functions();
        $defined_callbacks = preg_grep($defined_functions_pattern, $defined_functions['internal']);

        foreach ($defined_callbacks as &$defined_callback) {
            $defined_callback = "'$defined_callback'";
        }

        return $defined_callbacks;
    }

    function get_helper_callbacks($callback_index = null, $defined_functions_pattern = null)
    {
        $callbacks = [];

        if (! is_null($callback_index) and $example_callbacks = $this->get_example_callbacks($callback_index)) {
            $callbacks = array_merge($callbacks, $example_callbacks);
        }

        if ($defined_functions_pattern and $defined_callbacks = $this->get_defined_callbacks($defined_functions_pattern)) {
            $callbacks = array_merge($callbacks, $defined_callbacks);
        }

        $callbacks = array_unique($callbacks);
        sort($callbacks);

        return $callbacks;
    }

    function post_exec_function()
    {}

    function pre_exec_function()
    {}

    function process()
    {
        try {
            set_error_handler([$this, 'add_error']);

            $this->function_exists();

            $this->pre_exec_function();
            $this->result = $this->exec_function();
            $this->post_exec_function();

            restore_error_handler();

        } catch (Exception $e) {
            $this->add_error($e->getCode(), $e->getMessage());
        }
    }

    function reset_unused_params($arg_number)
    {
        for (; $arg_number <= 9 and isset($this->_synopsis->arg_names[$arg_number]); $arg_number++) {
            $arg_name = $this->_synopsis->arg_names[$arg_number];
            $this->_params->params[$arg_name] = '';
        }
    }

    function run()
    {
        $this->process();
        parent::run();
    }

    function set_arg_value($arg_number, &$values, &$result)
    {
        $arg_name = $copy = $this->_synopsis->arg_names[$arg_number];
        $values[$arg_number] = $this->_params->get_param($arg_name);

        if ($this->_synopsis->is_reference_arg($arg_name)) {
            // this is an arg passed by reference
            $arg_name = $this->_params->get_param($arg_name, false);

            if (! $this->_params->is_param_var($arg_name)) {
                // a value instead of a var name was passed, triggers an error
                $arg_name = $this->_converter->convert_value_to_text($arg_name, true);
                $message = $this->_translation->translate('a value cannot be passed by reference') . " (\$$copy: $arg_name)";
                throw new Exception($message, E_USER_ERROR);
            }

            $arg_name = $this->_params->get_var_name($arg_name);
            // links a position in the result array to where the value will be returned by reference
            $result[$arg_name] = &$values[$arg_number];
        }
    }
}
