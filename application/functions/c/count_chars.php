<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class count_chars extends function_core
{
    public $examples = [
        ["Two Ts and one F.", 1]
    ];

    public $options_range = ['mode' => [0, 4]];

    public $synopsis = 'mixed count_chars ( string $string [, int $mode = 0 ] )';
}
