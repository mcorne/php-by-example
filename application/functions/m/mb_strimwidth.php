<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_check_encoding.php';

class mb_strimwidth extends mb_check_encoding
{
    public $examples = [
        ["Hello World", 0, 10, '...', 'UTF-8']
    ];

    public $synopsis = 'string mb_strimwidth ( string $str , int $start , int $width [, string $trimmarker = &quot;&quot; [, string $encoding = mb_internal_encoding() ]] )';
}
