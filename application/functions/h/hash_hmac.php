<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class hash_hmac extends function_core
{
    public $examples = [
        ["ripemd160", "The quick brown fox jumped over the lazy dog.", "secret"]
    ];

    public $synopsis = 'string hash_hmac ( string $algo , string $data , string $key [, bool $raw_output = false ] )';
}
