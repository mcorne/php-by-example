<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class str_ireplace extends function_core
{
    public $examples = [
        [
            "%body%",
            "black",
            "<body text=%BODY%>"
        ]
    ];

    public $synopsis = 'mixed str_ireplace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )';
}
