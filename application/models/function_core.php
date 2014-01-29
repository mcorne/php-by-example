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
    public $examples = [[]]; // one example with no param by default
    public $returned_params;
    public $tests = [];

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

    function post_exec_function()
    {}

    function pre_exec_function()
    {}

    function process()
    {
        try {
            set_error_handler([$this, 'add_error']);

            $this->function_exists();

            $this->reset_args_after_first_empty_param();

            $this->pre_exec_function();
            $this->result = $this->exec_function();
            $this->post_exec_function();

            restore_error_handler();

        } catch (Exception $e) {
            $this->add_error($e->getCode(), $e->getMessage());
        }
    }

    function reset_args_after_first_empty_param()
    {
        for ($arg_number = 0; $arg_number <= 9 and isset($this->_synopsis->arg_names[$arg_number]); $arg_number++) {
            $arg_name = $this->_synopsis->arg_names[$arg_number];

            if (isset($reset_args) and $this->_params->param_exists($arg_name)) {
                $this->_params->params[$arg_name] = '';
                $reset_args[] = "\$$arg_name";

            } else if (! $this->_params->param_exists($arg_name)) {
                $reset_args = [];
            }
        }

        if (! empty($reset_args)) {
            if (count($reset_args) == 1) {
                $reset_args = current($reset_args);
                $message = $this->_translation->translate('the following argument has been removed') . " ($reset_args)";
            } else {
                $reset_args = implode(', ', $reset_args);
                $message = $this->_translation->translate('the following arguments have been removed') . " ($reset_args)";
            }

            trigger_error($message, E_USER_NOTICE);
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
