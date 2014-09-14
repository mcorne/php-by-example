<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_convert_case.php';

class mb_strtolower extends mb_convert_case
{
    public $examples = [
        "Mary Had A Little Lamb and She LOVED It So",
        ["Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός", "UTF-8"]
    ];

    public $synopsis = 'string mb_strtolower ( string $str [, string $encoding = mb_internal_encoding() ] )';
}
