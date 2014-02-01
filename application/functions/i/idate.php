<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/s/strftime.php';

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
