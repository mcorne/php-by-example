<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * default action for basic actions, eg "home"
 * specific actions, eg "function_core", must extend this class
 */

class action extends object
{
    function process()
    {}

    final function run()
    {
        $this->process();
        $this->_params->set_cookie_params();
        require "$this->application_path/views/layout.phtml";
    }
}
