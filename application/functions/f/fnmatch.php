<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class fnmatch extends function_core
{
    public $examples = [
        ["*gr[ae]y", 'gray']
    ];

    public $synopsis = 'bool fnmatch ( string $pattern , string $string [, int $flags = 0 ] )';
}
