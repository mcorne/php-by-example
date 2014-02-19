<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class strspn extends function_core
{
    public $examples = [
        [
            "42 is the answer to the 128th question.",
            "1234567890"
        ],
        [
            "foo",
            "o"
        ],
        [
            "foo",
            "o",
            1,
            2
        ],
        [
            "foo",
            "o",
            1,
            1
        ]
    ];

    public $synopsis = 'int strspn ( string $subject , string $mask [, int $start [, int $length ]] )';
}
