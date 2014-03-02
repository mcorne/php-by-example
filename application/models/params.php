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
 * params extraction
 */

class params extends object
{
    function _get_email()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];

        } else if (isset($_COOKIE['email'])) {
            $email = $_COOKIE['email'];

        } else {
            $email = null;
        }

        setcookie('email', $email, time() + 60*60*24*30, '/');

        return $email;
    }

    function _get_php_manual_location()
    {
        if (isset($_GET['php_manual_location'])) {
            $php_manual_location = $_GET['php_manual_location'];

        } else if (isset($_COOKIE['php_manual_location'])) {
            $php_manual_location = $_COOKIE['php_manual_location'];
        }

        if (! isset($php_manual_location) or $php_manual_location != 'php.net' and $php_manual_location != 'none') {
            $php_manual_location = 'local_copy';
        }

        setcookie('php_manual_location', $php_manual_location, time() + 60*60*24*30, '/');

        return $php_manual_location;
    }

    function _get_search_method()
    {
        if (isset($_GET['search_method'])) {
            $search_method = $_GET['search_method'];

        } else if (isset($_COOKIE['search_method'])) {
            $search_method = $_COOKIE['search_method'];
        }

        if (! isset($search_method) or $search_method != 'select') {
            $search_method = 'input';
        }

        setcookie('search_method', $search_method, time() + 60*60*24*30, '/');

        return $search_method;
    }

    function _get_params()
    {
        return $_POST;
    }

    function get_param($param_name)
    {
        if (! $this->param_exists($param_name)) {
            return null;
        }

        $value = trim($this->params[$param_name]);

        return $value;
    }

    function param_exists($param_name)
    {
        // checks if a param value is different from an empty string which means something was passed
        $exists = (array_key_exists($param_name, $this->params) and trim($this->params[$param_name]) !== '');

        return $exists;
    }
}
