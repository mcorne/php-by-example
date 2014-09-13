<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_check_encoding.php';

class mb_strlen extends mb_check_encoding
{
    public $examples = [
        ["español", 'UTF-8'],
    ];

    public $synopsis = 'mixed mb_strlen ( string $str [, string $encoding = mb_internal_encoding() ] )';
}
