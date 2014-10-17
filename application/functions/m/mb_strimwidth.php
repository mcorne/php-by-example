<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_convert_case.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mb_strimwidth extends mb_convert_case
{
    public $examples = [
        ["Hello World", 0, 10, '...']
    ];

    public $synopsis = 'string mb_strimwidth ( string $str , int $start , int $width [, string $trimmarker = &quot;&quot; [, string $encoding = mb_internal_encoding() ]] )';
}
