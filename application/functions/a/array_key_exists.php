<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class array_key_exists extends function_core
{
    public $examples = [
        [
            'first',
            [
                'first' => 1,
                'second' => 4
            ],
        ],
        [
            'first',
            [
                'first' => null,
                'second' => 4
            ],
        ],
    ];

    public $synopsis = 'bool array_key_exists ( mixed $key , array $array )';
}
