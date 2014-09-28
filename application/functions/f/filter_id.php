<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class filter_id extends function_core
{
    public $examples = ["boolean"];

    public $options_getter = ['filtername' => 'filter_list'];

    public $synopsis = 'int filter_id ( string $filtername )';
}
