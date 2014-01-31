<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class hash extends function_core
{
    public $examples = [
        ["ripemd160", "The quick brown fox jumped over the lazy dog."]
    ];

    public $synopsis = 'string hash ( string $algo , string $data [, bool $raw_output = false ] )';
}
