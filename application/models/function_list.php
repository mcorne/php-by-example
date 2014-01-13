<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class function_list extends object
{
    function create_function_list($function_directory)
    {
        $filenames = glob("$function_directory/*.php");

        foreach ($filenames as $filename) {
            $function_basename = basename($filename, '.php');

            if ($this->is_class_method($function_basename)) {
                // this is a class method, extracts the exact class and method names from the synopsis
                $function = $this->_function_factory->create_function_object($function_basename);
                $function_list[$function_basename] = $function->_synopsis->_get_function_name();

            } else {
                // this is a function, sets the function name to the function file basename
                $function_list[$function_basename] = $function_basename;
            }
        }

        ksort($function_list);

        return $function_list;
    }

    function get_function_list()
    {
        $function_list_filename = sprintf('%s/data/function_list.php', $this->application_path);
        $function_directory = sprintf('%s/functions', $this->application_path);

        if (! file_exists($function_list_filename) or filemtime($function_list_filename) < filemtime($function_directory)) {
            // the file where the function list is stored does not exist or is obsolete, stores the function list the that file
            $function_list = $this->create_function_list($function_directory);
            $this->_file->write_array($function_list_filename, $function_list);

        } else {
            // reads the function list from the file
            $function_list = $this->_file->read_array($function_list_filename);
        }

        return $function_list;
    }

    function is_class_method($function_basename)
    {
        $is_class_method = (bool) strpos($function_basename, '__');

        return $is_class_method;
    }
}
