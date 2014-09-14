<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class jdtojewish extends function_core
{
    public $constant_prefix = ['fl' => 'CAL_JEWISH_ADD'];

    public $examples = [
        2451545,
        [
            2451545,
            true,
            'CAL_JEWISH_ADD_ALAFIM | CAL_JEWISH_ADD_ALAFIM_GERESH | CAL_JEWISH_ADD_GERESHAYIM',
        ]
    ];

    public $multi_select = ['fl' => true];

    public $source_code = '
inject_function_call

// converts the date to UTF-8 for readability if $_hebrew is true
if ($_hebrew)
    $date = iconv("ISO-8859-8", "UTF-8", $string);
';

    public $synopsis = 'string jdtojewish ( int $juliandaycount [, bool $hebrew = false [, int $fl = 0 ]] )';

    function post_exec_function()
    {
        if ($this->_filter->filter_arg_value('hebrew')) {
            $this->result['date'] = iconv("ISO-8859-8", "UTF-8", $this->result['string']);
        }
    }
}
