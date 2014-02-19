<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class serialize extends function_core
{
    public $examples = [
        [
            [
                'a' => 123,
                456 => ['bcd']
            ]
        ]
    ];

    public $synopsis = 'string serialize ( mixed $value )';
}
