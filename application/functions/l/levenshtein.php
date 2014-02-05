<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class levenshtein extends function_core
{
    public $examples = [
        ["carrrot", 'apple'],
        ["carrrot", 'pineapple'],
        ["carrrot", 'banana'],
        ["carrrot", 'orange'],
        ["carrrot", 'radish'],
        ["carrrot", 'carrot'],
        ["carrrot", 'pea'],
        ["carrrot", 'bean'],
        ["carrrot", 'potato'],
    ];

    // public $synopsis    = 'int levenshtein ( string $str1 , string $str2 )';
    public $synopsis       = 'int levenshtein ( string $str1 , string $str2 , int $cost_ins , int $cost_rep , int $cost_del )';
    public $synopsis_fixed = 'int levenshtein ( string $str1 , string $str2 [, int $cost_ins [, int $cost_rep [, int $cost_del ]]] )';
}
