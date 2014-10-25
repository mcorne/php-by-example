<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

/**
 * returns the content of a custom function file
 */

class custom_function extends action
{
    /**
     * list of classes, and functions in files with a name not based on the function name
     * @var array
     */
    public $basenames = [
        'pbx_callbacks'        => ['pbx_callbacks.php'     , 'class'],
        'pbx_get_city_lat_lng' => ['pbx_cities_lat_lng.php', 'function'],
    ];

    function add_link_to_custom_filename($match)
    {
        list(, $require_once, $filename, $custom_function_name) = $match;
        $href = $this->_output->display_url('function', $custom_function_name);
        $link = sprintf('%s<a href="%s">%s</a>', $require_once, $href, $filename);

        return $link;
    }

    function add_link_to_custom_filenames($highlighted_code)
    {
        $highlighted_code = preg_replace_callback("~(require_once.+?')((\w+).php)~", [$this, 'add_link_to_custom_filename'], $highlighted_code);

        return $highlighted_code;
    }

    function custom_function_exists($function_basename)
    {
        $filename = "$this->application_path/custom/$function_basename.php";
        $custom_function_exists = file_exists($filename);

        return $custom_function_exists;
    }

    function process()
    {
        if (! $this->_application->custom_function_name) {
            return;
        }

        if (isset($this->basenames[$this->_application->custom_function_name])) {
            list($this->basename, $this->type) = $this->basenames[$this->_application->custom_function_name];

        } else {
            // defaults the file name to the function name
            $this->basename = $this->_application->custom_function_name . '.php';
            $this->type = 'function';
        }

        $sub_path = "custom/$this->basename";
        $filename = "$this->application_path/$sub_path";

        if (! file_exists($filename)) {
            $this->error = 'File not found: ' . $sub_path;
            return;
        }

        $highlighted_code = highlight_file($filename, true);

        if ($this->_application->custom_function_name == 'pbx_text_to_html') {
            $highlighted_code = $this->_output->add_link_to_internal_doc($highlighted_code, 'sample');
        }

        $highlighted_code = $this->_output->remove_email_address($highlighted_code);
        $this->highlighted_code = $this->add_link_to_custom_filenames($highlighted_code);
    }
}
