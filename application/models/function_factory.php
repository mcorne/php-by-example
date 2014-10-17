<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class function_factory extends object
{
    public $fixed_classnames = [
        'define' => 'define_',
    ];

    function create_function_object($function_basename)
    {
        $function_sub_directory = $function_basename[0];
        $class_name = isset($this->fixed_classnames[$function_basename]) ? $this->fixed_classnames[$function_basename] : null;
        $function = $this->create_object($function_basename, "functions/$function_sub_directory", 'function', $class_name);

        return $function;
    }
}
