<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class getrusage extends function_core
{
    public $options_range = ['who' => [0, 1]];

    public $synopsis = 'array getrusage ([ int $who = 0 ] )';

    public $test_not_validated = true;
}
