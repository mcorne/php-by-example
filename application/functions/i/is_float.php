<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class is_float extends function_core
{
    public $examples = [27.25, "abc", 23, 23.5, '_NO_QUOTE_1e7', true];

    public $synopsis = 'bool is_float ( mixed $var )';
}
