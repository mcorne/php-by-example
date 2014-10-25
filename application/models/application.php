<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * application action controller
 * entry point: run()
 */

class application extends object
{

    function _get_custom_function_name()
    {
        $custom_function_name = (isset($this->uri[2]) and strpos($this->uri[2], 'pbx_') === 0) ? $this->uri[2] : null;

        return $custom_function_name;
    }

    function _get_doc_name()
    {
        $doc_name = isset($this->uri[2]) ? $this->uri[2] : null;

        return $doc_name;
    }

    function _get_function_basename()
    {
        if (! isset($this->uri[2])) {
            return null;
        }

        $function_basename = str_replace('::', '__', $this->uri[2]);
        $function_basename = strtolower($function_basename);

        if (! $this->_function_list->function_exists($function_basename)) {
            return null;
        }

        return $function_basename;
    }

    function _get_function_name()
    {
        if (! $this->function_basename) {
            return null;
        }

        $function_name = $this->_function_list->get_function_name($this->function_basename);

        return $function_name;
    }

    function _get_function_name_part()
    {
        $function_name_part = isset($this->uri[2]) ? $this->uri[2] : null;

        return $function_name_part;
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

    function create_function()
    {
        $function_basename = end($this->uri);

        if ($this->_function_list->function_exists($function_basename)) {
            $this->_function_factory->create_function_object($function_basename);
        }
    }

    function run()
    {
        try {
            $this->action_name = isset($this->uri[1]) ? $this->uri[1] : null;

            switch ($this->action_name) {
                case 'config':
                case 'doc':
                case 'messages_translation':
                case 'translations_stats':
                case 'translators_stats':
                    $object_name = '_' . $this->action_name;
                    $action = $this->$object_name;
                    break;

                case 'function':
                    if ($this->custom_function_name) {
                        $action = $this->_custom_function;
                        $this->action_name = 'custom_function';

                    } else if ($this->function_basename) {
                        $action = $this->_function_factory->create_function_object($this->function_basename);
                        $this->_params->php_manual_location; // sends cookie before headers

                    } else if ($this->function_name_part) {
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
                        $this->_params->php_manual_location; // sends cookie before headers
                    }
                    break;

                case 'test_all':
                    $action = $this->_function_test_all;
                    break;

                case 'unit_test':
                    if (! $this->unit_test_name) {
                        $action = $this->_unit_test_all;
                        $this->action_name = 'unit_test_all';

                    } else {
                        if ($this->function_name) {
                            $this->unit_test_name = $this->_unit_test_list->get_function_unit_test_name($this->function_basename);
                            $this->_params->php_manual_location; // sends cookie before headers

                        } else if ($this->custom_function_name) {
                            $this->unit_test_name = $this->_unit_test_list->get_custom_function_unit_test_name($this->custom_function_name);

                        } else {
                            list($this->function_name, $this->custom_function_name) = $this->_unit_test_list->get_function_name($this->unit_test_name);
                        }

                        if ($this->_unit_test_list->is_testable_class($this->unit_test_name)) {
                            $action = $this->_unit_test;

                        } else {
                            $this->action_name = 'unit_test';
                            $action = $this->_action;
                        }
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
