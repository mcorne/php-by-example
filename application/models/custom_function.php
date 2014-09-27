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
 * returns the content of a custom function file
 */

class custom_function extends action
{
    public $filenames = [
        'pbx_callbacks'        => ['pbx_callbacks.php'     , 'class'],
        'pbx_get_city_lat_lng' => ['pbx_cities_lat_lng.php', 'function'],
    ];

    function process()
    {
        if (! isset($this->filenames[$this->_application->function_basename])) {
            $this->error = 'Invalid function or class name: ' . $this->_application->function_basename;
            return;
        }

        list($this->filename, $this->type) = $this->filenames[$this->_application->function_basename];
        $this->filepath = $this->application_path . '/custom-functions/' . $this->filename;

        if (! file_exists($this->filepath)) {
            $this->error = 'File not found: ' . $this->filename;
        }
    }

    function run()
    {
        $this->process();
        parent::run();
    }
}
