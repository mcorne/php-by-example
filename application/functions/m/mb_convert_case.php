<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_check_encoding.php';

class mb_convert_case extends mb_check_encoding
{
    public $constant_prefix = ['mode' => 'MB_CASE'];

    public $examples = [
        ["mary had a Little lamb and she loved it so", 'MB_CASE_UPPER', "UTF-8"],
        ["mary had a Little lamb and she loved it so", 'MB_CASE_TITLE', "UTF-8"],
        ["Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός", 'MB_CASE_UPPER', "UTF-8"],
        ["Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός", 'MB_CASE_TITLE', "UTF-8"]
    ];

    public $synopsis = 'string mb_convert_case ( string $str , int $mode [, string $encoding = mb_internal_encoding() ] )';
}
