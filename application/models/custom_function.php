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
    /**
     * list of classes, and functions in files with a name not based on the function name
     * @var array
     */
    public $filenames = [
        'pbx_callbacks'        => ['pbx_callbacks.php'     , 'class'],
        'pbx_get_city_lat_lng' => ['pbx_cities_lat_lng.php', 'function'],
        'pbx_hash_array'       => ['pbx_hash.php'          , 'function'],
        'pbx_hash_int'         => ['pbx_hash.php'          , 'function'],
        'pbx_hash_string'      => ['pbx_hash.php'          , 'function'],
    ];

    function process()
    {
        if (isset($this->filenames[$this->_application->function_basename])) {
            list($this->filename, $this->type) = $this->filenames[$this->_application->function_basename];

        } else {
            // defaults the file name to the function name
            $this->filename = $this->_application->function_basename . '.php';
            $this->type = 'function';
        }

        $this->filepath = $this->application_path . '/custom/' . $this->filename;

        if (! file_exists($this->filepath)) {
            $this->error = 'File not found: ' . $this->filename;
        }
    }
}
