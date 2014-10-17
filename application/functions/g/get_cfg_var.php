<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class get_cfg_var extends function_core
{
    public $examples = ['register_globals'];

    public $synopsis = 'string get_cfg_var ( string $option )';

    public $test_not_validated = true;

    function _get_options_list()
    {
        foreach (array_keys(ini_get_all(null, false)) as $var_name) {
            if (ini_get($var_name)) {
                $var_names[] = $var_name;
            }
        }

        if (! isset($var_names)) {
            return [];
        }

        $options_list = [
            'option'  => $var_names, // used by get_cfg_var()
            'varname' => $var_names, // used by ini_get()
        ];

        return $options_list;
    }

    function post_exec_function()
    {
        $string = $this->result['string'];

        if ($string !== false) {
            $option = $this->_filter->filter_arg_value('option') or // used by get_cfg_var()
            $option = $this->_filter->filter_arg_value('varname');   // used by ini_get()

            $excluded_keys = '~^(arg_separator|bcmath|date|default_charset|highlight|iconv|intl|mbstring|pcre|precision|zlib)~';
            $hash = $this->hash([$option => $string], $excluded_keys);
            $this->result['string'] = current($hash);
        }
    }
}
