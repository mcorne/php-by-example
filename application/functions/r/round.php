<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class round extends function_core
{
    public $constant_prefix = ['mode' => 'PHP_ROUND'];

    public $examples = [
        3.4,
        3.5,
        3.6,
        [3.6, 0],
        [1.95583, 2],
        [1241757, -3],
        [5.045, 2],
        [5.055, 2],
        [9.5, 0, 'PHP_ROUND_HALF_UP'],
        [9.5, 0, 'PHP_ROUND_HALF_DOWN'],
        [9.5, 0, 'PHP_ROUND_HALF_EVEN'],
        [9.5, 0, 'PHP_ROUND_HALF_ODD'],
        [8.5, 0, 'PHP_ROUND_HALF_UP'],
        [8.5, 0, 'PHP_ROUND_HALF_DOWN'],
        [8.5, 0, 'PHP_ROUND_HALF_EVEN'],
        [8.5, 0, 'PHP_ROUND_HALF_ODD'],
        [ 1.55, 1, 'PHP_ROUND_HALF_UP'],
        [ 1.54, 1, 'PHP_ROUND_HALF_UP'],
        [-1.55, 1, 'PHP_ROUND_HALF_UP'],
        [-1.54, 1, 'PHP_ROUND_HALF_UP'],
        [ 1.55, 1, 'PHP_ROUND_HALF_DOWN'],
        [ 1.54, 1, 'PHP_ROUND_HALF_DOWN'],
        [-1.55, 1, 'PHP_ROUND_HALF_DOWN'],
        [-1.54, 1, 'PHP_ROUND_HALF_DOWN'],
        [ 1.55, 1, 'PHP_ROUND_HALF_EVEN'],
        [ 1.54, 1, 'PHP_ROUND_HALF_EVEN'],
        [-1.55, 1, 'PHP_ROUND_HALF_EVEN'],
        [-1.54, 1, 'PHP_ROUND_HALF_EVEN'],
        [ 1.55, 1, 'PHP_ROUND_HALF_ODD'],
        [ 1.54, 1, 'PHP_ROUND_HALF_ODD'],
        [-1.55, 1, 'PHP_ROUND_HALF_ODD'],
        [-1.54, 1, 'PHP_ROUND_HALF_ODD'],
    ];

    public $synopsis = 'float round ( float $val [, int $precision = 0 [, int $mode = PHP_ROUND_HALF_UP ]] )';
}
