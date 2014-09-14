<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_convert_case.php';

class mb_strcut extends mb_convert_case
{
    public $examples = [
        ['español', 4, 2],
        ['español', 4, 3, 'UTF-8'],
        ['español', 5, 1, 'UTF-8'],
        ['español', 5, 2, 'UTF-8'],
    ];

    public $synopsis = 'string mb_strcut ( string $str , int $start [, int $length = NULL [, string $encoding = mb_internal_encoding() ]] )';
}
