<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class date extends function_core
{
    public $constant_prefix = ['format' => 'DATE'];

    public $examples = [
        ['l', 962409600],
        ['_SINGLE_QUOTE_l jS \of F Y h:i:s A_SINGLE_QUOTE_', 962409600],
        ['DATE_RFC2822', 962409600],
        ['DATE_ATOM', 962409600],
        ['_SINGLE_QUOTE_l \t\h\e jS_SINGLE_QUOTE_', 962409600],
        ['F j, Y, g:i a', 962409600],
        ['m.d.y', 962409600],
        ['j, n, Y', 962409600],
        ['Ymd', 962409600],
        ['h-i-s, j-m-y, it is w Day', 962409600],
        ['_SINGLE_QUOTE_\i\t \i\s \t\h\e jS \d\a\y._SINGLE_QUOTE_', 962409600],
        ['D M j G:i:s T Y', 962409600],
        ['_SINGLE_QUOTE_H:m:s \m \i\s\ \m\o\n\t\h_SINGLE_QUOTE_', 962409600],
        ['H:i:s', 962409600],
        ['Y-m-d H:i:s', 962409600],
    ];

    public $source_code = '
date_default_timezone_set("UTC");

inject_function_call
';

    public $synopsis = 'string date ( string $format [, int $timestamp = time() ] )';

    function pre_exec_function()
    {
        date_default_timezone_set("UTC");
    }
}
