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

class mb_substr extends mb_convert_case
{
    public $examples = [
        ["español", 3, 3, 'UTF-8'],
    ];

    public $synopsis = 'string mb_substr ( string $str , int $start [, int $length = NULL [, string $encoding = mb_internal_encoding() ]] )';
}
