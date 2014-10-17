<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

class config extends action
{
    function add_link_to_config_filename($match)
    {
        list(, $require_once, $filename, $function_basename) = $match;
        $function_name = $this->_function_list->get_function_name($function_basename);
        $href = $this->_output->display_url('config', $function_name);
        $link = sprintf('%s<a href="%s">%s</a>', $require_once, $href, $filename);

        return $link;
    }

    function add_link_to_config_filenames($highlighted_code)
    {
        $highlighted_code = preg_replace_callback("~(require_once.+?')((?:functions/\w/)?(\w+).php)~", [$this, 'add_link_to_config_filename'], $highlighted_code);

        return $highlighted_code;
    }

    function process()
    {
        if (! $this->_application->function_basename) {
            return;
        }

        $function_sub_directory = $this->_application->function_basename[0];
        $sub_path = "functions/$function_sub_directory/{$this->_application->function_basename}.php";
        $filename = "$this->application_path/$sub_path";

        if (! file_exists($filename)) {
            $this->error = 'File not found: ' . $sub_path;
            return;
        }

        $highlighted_code = highlight_file($filename, true);
        $highlighted_code = $this->_output->remove_email_address($highlighted_code);
        $this->highlighted_code = $this->add_link_to_config_filenames($highlighted_code);
    }
}
