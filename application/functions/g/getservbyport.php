<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class getservbyport extends function_core
{
    public $examples = [
        [80, "tcp"]
    ];

    public $synopsis = 'string getservbyport ( int $port , string $protocol )';

    public $test_always_valid = true;
}
