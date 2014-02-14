<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_split extends function_core
{
    public $examples = [
        ['/[\s,]+/', "hypertext language, programming"],
        ['//', "string", -1, 'PREG_SPLIT_NO_EMPTY'],
        ['/ /', "hypertext language programming", -1, 'PREG_SPLIT_OFFSET_CAPTURE'],
    ];

    public $synopsis = 'array preg_split ( string $pattern , string $subject [, int $limit = -1 [, int $flags = 0 ]] )';
}
