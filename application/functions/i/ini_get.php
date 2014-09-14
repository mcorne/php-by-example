<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class ini_get extends function_core
{
    public $examples = ["display_errors", "register_globals", "post_max_size", "post_max_size"];

    public $synopsis = 'string ini_get ( string $varname )';

    public $test_not_validated = true;

    function _get_options_list()
    {
        foreach (array_keys(ini_get_all(null, false)) as $var_name) {
            if (ini_get($var_name)) {
                $var_names[] = $var_name;
            }
        }

        $options_list = isset($var_names) ? ['varname' => $var_names] : [];

        return $options_list;
    }
}
