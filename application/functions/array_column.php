<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_column extends function_core
{
    public $examples = [
        [
            [
                [
                    'id' => 2135,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                ],
                [
                    'id' => 3245,
                    'first_name' => 'Sally',
                    'last_name' => 'Smith',
                ],
                [
                    'id' => 5342,
                    'first_name' => 'Jane',
                    'last_name' => 'Jones',
                ],
                [
                    'id' => 5623,
                    'first_name' => 'Peter',
                    'last_name' => 'Doe',
                ],
            ],
            'first_name',
        ],
        [
            [
                [
                    'id' => 2135,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                ],
                [
                    'id' => 3245,
                    'first_name' => 'Sally',
                    'last_name' => 'Smith',
                ],
                [
                    'id' => 5342,
                    'first_name' => 'Jane',
                    'last_name' => 'Jones',
                ],
                [
                    'id' => 5623,
                    'first_name' => 'Peter',
                    'last_name' => 'Doe',
                ],
            ],
            'first_name',
            'id',
        ],
    ];

    public $synopsis = 'array array_column ( array $array , mixed $column_key [, mixed $index_key = null ] )';
}
