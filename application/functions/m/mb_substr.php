<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_check_encoding.php';

class mb_substr extends mb_check_encoding
{
    public $examples = [
        ["español", 3, 3, 'UTF-8'],
    ];

    public $synopsis = 'string mb_substr ( string $str , int $start [, int $length = NULL [, string $encoding = mb_internal_encoding() ]] )';
}
