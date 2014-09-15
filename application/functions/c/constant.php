<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class constant extends function_core
{
    public $examples = ["E_ALL"];

    public $synopsis = 'mixed constant ( string $name )';

    function _get_options_list()
    {
        $constants = get_defined_constants();
        $options_list = ['name' => array_keys($constants)];

        return $options_list;
    }
}
