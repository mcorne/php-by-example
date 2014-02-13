<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_quote extends function_core
{
    public $examples = [
        ['$40 for a g3/400', "/"],
        '*very*'
    ];

    public $synopsis = 'string preg_quote ( string $str [, string $delimiter = NULL ] )';
}
