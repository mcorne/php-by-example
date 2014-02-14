<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_replace_callback extends function_core
{
    public $source_code = '
$to_lower  = function ($matches) { return strtolower($matches[0]); };
$next_year = function ($matches) { return $matches[1] . ($matches[2] + 1); };
inject_function_call
';

    public $examples = [
        [
            '|<p>\s*\w|',
            '$to_lower',
            "<p>There is an elephant</p>",
        ],
        [
            '|(\d{2}/\d{2}/)(\d{4})|',
            '$next_year',
            "April fools day is 04/01/2002\nLast christmas was 12/24/2001\n",
        ]
    ];

    public $helper_callbacks = ['index_in_example' => 1];

    public $synopsis = 'mixed preg_replace_callback ( mixed $pattern , callable $callback , mixed $subject [, int $limit = -1 [, int &$count ]] )';

    function pre_exec_function()
    {
        $this->returned_params['callback'] = $this->_filter->filter_callback('callback');
    }
}
