<?php
/**
 * PHP By Example
 *
 * @copyright 2017 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/o/openssl_random_pseudo_bytes.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class random_bytes extends openssl_random_pseudo_bytes
{
    public $examples = [5];

    public $synopsis = 'string random_bytes ( int $length )';
}
