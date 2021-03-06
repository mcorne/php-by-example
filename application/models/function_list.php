<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * returns the list of functions
 * updates the list automatically when functions are added or removed
 */

class function_list extends object
{
    function _get_function_list()
    {
        $function_list_filename = sprintf('%s/data/function_list.php', $this->application_path);

        if (! file_exists($function_list_filename) or filemtime($function_list_filename) < $this->get_function_sub_directories_max_time()) {
            // the file does not exist or is obsolete, creates and stores the function list in the file
            $function_list = $this->create_function_list();
            $this->_file->write_array($function_list_filename, $function_list);

        } else {
            // reads the function list from the file
            $function_list = $this->_file->read_array($function_list_filename);
        }

        return $function_list;
    }

    function _get_function_list_mtime()
    {
        $function_list_filename = sprintf('%s/data/function_list.php', $this->application_path);
        $function_list_js_filename = sprintf('%s/function_list.js', $this->public_path);

        if (! file_exists($function_list_filename) or ! file_exists($function_list_js_filename) or
            filemtime($function_list_js_filename) < filemtime($function_list_filename))
        {
            $function_list = $this->create_js_function_list();
            $this->_file->write_content($function_list_js_filename, $function_list);
        }

        $function_list_mtime = filemtime($function_list_filename);

        return $function_list_mtime;
    }

    function _get_function_matches()
    {
        $pattern = preg_quote($this->_application->function_name_part, '~');
        $function_matches = preg_grep("~$pattern~i", $this->function_list);

        return $function_matches;
    }

    function create_function_list()
    {
        $filenames = glob("{$this->application_path}/functions/*/*.php");

        foreach ($filenames as $filename) {
            $function_basename = basename($filename, '.php');

            if ($this->is_class_method($function_basename)) {
                // this is a class method, extracts the exact class and method names from the synopsis
                $this->_function_factory->create_function_object($function_basename);
                $this->create_object('synopsis');
                $function_list[$function_basename] = $this->_synopsis->function_name;

            } else {
                // this is a function, sets the function name to the function file basename
                $function_list[$function_basename] = $function_basename;
            }
        }

        ksort($function_list);

        return $function_list;
    }

    function create_js_function_list()
    {
        $options = '';

        foreach (array_values($this->function_list) as $function_name) {
            $options .= "<option>$function_name</option>";
        }

        $function_list = "var function_list = '$options';";

        return $function_list;
    }

    function function_exists($function_basename)
    {
        $function_exists = isset($this->function_list[$function_basename]);

        return $function_exists;
    }

    function get_function_name($function_basename)
    {
        $function_name = isset($this->function_list[$function_basename]) ? $this->function_list[$function_basename] : null;

        return $function_name;
    }

    function get_function_name_around($direction)
    {
        $function_basenames = array_keys($this->function_list);
        $index = array_search($this->_application->function_basename, $function_basenames) + $direction;
        $function_name = isset($function_basenames[$index]) ? $this->function_list[ $function_basenames[$index] ] : null;

        return $function_name;
    }

    function get_function_sub_directories_max_time()
    {
        $function_sub_directories = glob("{$this->application_path}/functions/*", GLOB_ONLYDIR);
        $function_sub_directories_times = array_map('filemtime', $function_sub_directories);
        $function_sub_directories_max_time = max($function_sub_directories_times);

        return $function_sub_directories_max_time;
    }

    function is_class_method($function_basename)
    {
        $is_class_method = (bool) strpos($function_basename, '__');

        return $is_class_method;
    }
}
