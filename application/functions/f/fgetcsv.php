<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'fgetc.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class fgetcsv extends fgetc
{
    public $examples = [
        [
            'data'    =>
                'one,two,three
                four,five,six
                seven,eight,nine
                ten,eleven,twelve',
            '__count' => 2,
            'handle'  => '$handle',
        ],
    ];

    public $synopsis = 'array fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = &quot;,&quot; [, string $enclosure = &#039;&quot;&#039; [, string $escape = &quot;\\&quot; ]]]] )';
}
