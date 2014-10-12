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
 * application action controller
 * entry point: run()
 */

class application extends object
{
    function _get_function_basename()
    {
        $function_basename = isset($this->uri[2]) ? $this->uri[2] : null;
        $function_basename = str_replace('::', '__', $function_basename);
        $function_basename = strtolower($function_basename);

        return $function_basename;
    }

    function _get_unit_test_name()
    {
        $unit_test_name = array_slice($this->uri, 2);
        $unit_test_name = implode('/', $unit_test_name);

        return $unit_test_name;
    }

    function _get_uri()
    {
        if (! isset($_SERVER['REQUEST_URI'])) {
            return null;
        }

        list($uri) = explode('?', $_SERVER['REQUEST_URI'], 2);
        $uri = str_replace('/php-by-example', '', $uri);
        $uri = trim($uri, '/');
        $uri = explode('/', $uri);

        return $uri;
    }

    function is_custom_function()
    {
        $is_custom_function = strpos($this->function_basename, 'pbx_') === 0;

        return $is_custom_function;
    }

    function run()
    {
        try {
            $this->action_name = isset($this->uri[1]) ? $this->uri[1] : null;

            switch ($this->action_name) {
                case 'custom_function':
                case 'messages_translation':
                case 'translations_stats':
                case 'translators_stats':
                    $object_name = '_' . $this->action_name;
                    $action = $this->$object_name;
                    break;

                case 'function':
                    if ($this->is_custom_function()) {
                        $action = $this->_custom_function;
                        $this->action_name = 'custom_function';

                    } else if ($this->_function_list->function_exists($this->function_basename)) {
                        $action = $this->_function_factory->create_function_object();

                    } else if ($this->function_basename) {
                        $this->action_name = 'search_function';
                        $action = $this->_action;
                    }
                    break;

                case 'function_list':
                case 'help':
                case 'home':
                case 'misc':
                    $action = $this->_action;
                    break;

                case 'test':
                    if ($this->_function_list->function_exists($this->function_basename)) {
                        $action = $this->_function_test;
                    }
                    break;

                case 'test_all':
                    $action = $this->_function_test_all;
                    break;

                case 'unit_test':
                    if (! $this->unit_test_name) {
                        $action = $this->_unit_test_all;
                        $this->action_name = 'unit_test_all';

                    } else if ($this->_unit_test_list->is_testable_class($this->unit_test_name)) {
                        $action = $this->_unit_test;
                    }
                    break;
            }

            if (! isset($action)) {
                $this->action_name = 'home';
                $action = $this->_action;
            }

            $action->run();

        } catch (Exception $e) {
            header("HTTP/1.0 500 Internal Server Error");
            require "$this->application_path/views/technical_problem.phtml";
            exit;
        }
    }
}
