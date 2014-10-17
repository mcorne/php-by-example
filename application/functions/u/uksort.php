<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'uasort.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class uksort extends uasort
{
    public $examples = [
        [
            '__array' => [
                "John" => 1,
                "the Earth" => 2,
                "an apple" => 3,
                "a banana" => 4,
            ],
            '$array',
            'compare_func',
        ]
    ];

    public $synopsis = 'bool uksort ( array &$array , callable $key_compare_func )';

    function pre_exec_function()
    {
        $this->_filter->filter_callback('key_compare_func');
    }
}
