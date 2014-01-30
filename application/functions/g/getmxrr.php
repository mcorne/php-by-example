<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class getmxrr extends function_core
{
    public $examples = [
        ['www.example.com', '$mxhosts']
    ];

    public $synopsis = 'bool getmxrr ( string $hostname , array &$mxhosts [, array &$weight ] )';

    public $test_always_valid = true;
}
