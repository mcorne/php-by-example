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
    /**
     * all params using cookies must be listed below so cookies can be sent before headers, see set_cookie_params()
     */
    public $cookie_params = [
        'email',
        'password',
        'php_manual_location',
        'search_method',
        'translation_key',
    ];

    function _get($name)
    {
        if (in_array($name, $this->cookie_params)) {
            $this->$name = $this->get_param_or_cookie($name);

        } else {
            $this->$name = $this->get_param($name);
        }

        return $this->$name;
    }

    function _get_params()
    {
        $params = $_GET + $_POST; // url params are to be picked up first

        return $params;
    }

    function _get_php_manual_location()
    {
        $php_manual_location = $this->get_param_or_cookie('php_manual_location');

        if (! isset($php_manual_location) or $php_manual_location != 'php.net' and $php_manual_location != 'none') {
            $php_manual_location = 'local_copy';
        }

        return $php_manual_location;
    }

    function _get_search_method()
    {
        $search_method = $this->get_param_or_cookie('search_method');

        if (is_null($search_method) or $search_method != 'select') {
            $search_method = 'input';
        }

        return $search_method;
    }

    function get_param($param_name)
    {
        if ($this->param_exists($param_name)) {
            $value = trim($this->params[$param_name]);
        } else {
            $value = null;
        }

        return $value;
    }

    function get_param_or_cookie($param_name)
    {
        $value = $this->get_param($param_name);

        if (! is_null($value)) {
            setcookie($param_name, $value, time() + 60*60*24*30, '/');

        } else if (isset($_COOKIE[$param_name])) {
            $value = $_COOKIE[$param_name];
            setcookie($param_name, $value, time() + 60*60*24*30, '/');

        } else {
            setcookie($param_name, '', 1, '/');
        }

        return $value;
    }

    function param_exists($param_name)
    {
        // checks if a param value is different from an empty string which means something was passed
        $exists = (array_key_exists($param_name, $this->params) and trim($this->params[$param_name]) !== '');

        return $exists;
    }

    function reset_cookie_param($param_name)
    {
        $this->$param_name = null;
        setcookie($param_name, '', 1, '/');
    }

    function set_cookie_params()
    {
        foreach ($this->cookie_params as $name) {
            if (! property_exists($this, $name)) {
                $this->$name = $this->get_param_or_cookie($name);
            }
        }
    }
}
