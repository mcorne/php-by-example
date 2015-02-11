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

class fgetss extends fgetc
{
    public $examples = [
        [
            'data'    =>
                "<html><body>
                   <p>Welcome!</p>
                </body></html>
                Text outside of the HTML block.",
            '__count' => 1,
            'handle'  => '$handle',
        ],
        [
            'data'    =>
                "<html><body>
                   <p>Welcome!</p>
                </body></html>
                Text outside of the HTML block.",
            '__count' => 1,
            'handle'  => '$handle',
            'length'  => 100,
            'allowable_tags' => '<p>',
        ],
    ];

    public $synopsis = 'string fgetss ( resource $handle [, int $length [, string $allowable_tags ]] )';
}
