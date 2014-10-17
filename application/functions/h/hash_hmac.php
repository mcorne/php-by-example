<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class hash_hmac extends function_core
{
    public $examples = [
        ["ripemd160", "The quick brown fox jumped over the lazy dog.", "secret"]
    ];

    public $options_getter = ['algo' => 'hash_algos'];

    public $synopsis = 'string hash_hmac ( string $algo , string $data , string $key [, bool $raw_output = false ] )';
}
