<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class function_factory extends object
{
    function create_function_object($function_basename = null)
    {
        if (! $function_basename) {
            $function_basename = $this->function_basename;
        }

        require_once 'models/function_core.php';
        // the function object must be created as a standalone controler with the current object properties as data
        // note that functions already have preset resources which a parent would have no access to
        $function_sub_directory = $function_basename[0];
        $function = $this->create_object($function_basename, "functions/$function_sub_directory", (array) $this);

        // sets the php manual location here before sending headers as it sets a cookie
        $function->_params->php_manual_location;

        return $function;
    }
}
