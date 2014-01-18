<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class application extends object
{
    function _get_function_basename()
    {
        $function_basename = isset($this->uri[2]) ? $this->uri[2] : null;
        $function_basename = str_replace('::', '__', $function_basename);

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

    function function_exists($function_basename)
    {
        $function_sub_directory = $function_basename[0];
        $function_file_name = sprintf('%s/functions/%s/%s.php', $this->application_path, $function_sub_directory, $function_basename);
        $exists = file_exists($function_file_name);

        return $exists;
    }

    function get_direction()
    {
        if (! isset($this->uri[3])) {
            $direction = null;

        } else if ($this->uri[3] == 'before') {
            $direction = -1;

        } else if ($this->uri[3] == 'after') {
            $direction = +1;

        } else {
            $direction = null;
        }

        return $direction;
    }

    /**
     * the application entry point
     */
    function run()
    {
        try {
            $this->start_time = microtime(true);

            $this->action_name = isset($this->uri[1]) ? $this->uri[1] : null;

            switch ($this->action_name) {
                case 'about':
                case 'help':
                case 'home':
                    $action = $this->_action;
                    break;

                case 'function':
                    if ($this->function_basename and $this->function_exists($this->function_basename)) {
                        if ($direction = $this->get_direction()) {
                            if ($function_basename = $this->_function_list->get_function_basename_around($direction)) {
                                $this->function_basename = $function_basename;
                            }
                        }

                        $action = $this->_function_factory->create_function_object();
                    }
                    break;

                case 'test':
                    if (! $this->function_basename or ! $this->function_exists($this->function_basename)) {
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
