<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class get_cfg_var extends function_core
{
    public $hash_result = true;

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
}
