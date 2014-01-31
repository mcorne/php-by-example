<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/s/strftime.php';

class gmstrftime extends strftime
{
    public $examples = [
        [
            'time' => "12/31/1998 00:00:20",
            "%b %d %Y %H:%M:%S",
            '$timestamp',
        ],
    ];

    public $synopsis = 'string gmstrftime ( string $format [, int $timestamp = time() ] )';
}
