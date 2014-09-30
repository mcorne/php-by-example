<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'function_core.php';
require_once 'object.php';

class function_factory extends object
{
    public $fixed_classnames = [
        'define' => 'define_',
    ];

    function create_function_object($function_basename = null)
    {
        if (! $function_basename) {
            $function_basename = $this->_application->function_basename;
        }

        $function_sub_directory = $function_basename[0];
        $classname = isset($this->fixed_classnames[$function_basename]) ? $this->fixed_classnames[$function_basename] : null;
        $function = $this->create_object($function_basename, "functions/$function_sub_directory", 'function', $classname);

        // sets the php manual location here before sending headers as it sets a cookie
        $function->_params->php_manual_location;

        return $function;
    }
}
