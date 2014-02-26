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

    function _get_uri()
    {
        list($uri) = explode('?', $_SERVER['REQUEST_URI'], 2);
        $uri = str_replace('/php-by-example', '', $uri);
        $uri = trim($uri, '/');
        $uri = explode('/', $uri);

        return $uri;
    }

    function function_exists()
    {
        $function_exists = ($this->function_basename and isset($this->_function_list->function_list[$this->function_basename]));

        return $function_exists;
    }

    function run()
    {
        try {
            $this->start_time = microtime(true);

            $this->action_name = isset($this->uri[1]) ? $this->uri[1] : null;

            switch ($this->action_name) {
                case 'about':
                case 'function_list':
                case 'help':
                case 'home':
                    $action = $this->_action;
                    break;

                case 'function':
                    if ($this->function_exists()) {
                        $action = $this->_function_factory->create_function_object();

                    } else {
                        $this->action_name = 'search_functions';
                        $action = $this->_action;
                    }
                    break;

                case 'test':
                    if (! $this->function_exists()) {
                        break;
                    }

                case 'test_all':
                    $classname = '_function_' . $this->action_name;
                    $action = $this->$classname;
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
