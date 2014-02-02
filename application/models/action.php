<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * default action for basic actions, eg "home"
 * specific actions, eg "function_core", must extend this class
 */

class action extends object
{
    function run()
    {
        require "$this->application_path/views/layout.phtml";
    }
}
