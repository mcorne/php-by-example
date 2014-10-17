<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/s/strftime.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class idate extends strftime
{
    public $examples = [
        [
            'time' => "1st January 2004",
            "y",
            '$timestamp',
        ],
    ];

    public $synopsis = 'int idate ( string $format [, int $timestamp = time() ] )';
}
