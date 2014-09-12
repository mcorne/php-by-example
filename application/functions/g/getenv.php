<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class getenv extends function_core
{
    public $examples = ["REMOTE_ADDR"];

    public $synopsis = 'string getenv ( string $varname )';

    public $test_not_validated = true;

    function _get_options_list()
    {
        foreach (array_keys($_ENV + $_SERVER) as $var_name) {
            if (getenv($var_name)) {
                $var_names[] = $var_name;
            }
        }

        $options_list = isset($var_names) ? ['varname' => $var_names] : [];

        return $options_list;
    }
}
