<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mhash.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mhash_keygen_s2k extends mhash
{
    public $examples = [
        [
            'MHASH_MD5',
            'Hello world!',
            'a grain of salt',
            8,
        ]
    ];

    public $synopsis = 'string mhash_keygen_s2k ( int $hash , string $password , string $salt , int $bytes )';
}
