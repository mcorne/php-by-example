<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_ereg.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mb_ereg_replace extends mb_ereg
{
    public $examples = [
        [
            'encoding' => 'UTF-8',
            '[i]',
            'I',
            'i have a big car',
        ],
    ];

    public $synopsis = 'string mb_ereg_replace ( string $pattern , string $replacement , string $string [, string $option = &quot;msr&quot; ] )';
    public $synopsis_fixed = null;
}
