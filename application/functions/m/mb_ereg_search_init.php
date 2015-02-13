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

class mb_ereg_search_init extends mb_ereg
{
    public $examples = [
        [
            'encoding' => 'UTF-8',
            'Peter is a boy.',
            '[i]',
        ],
        [
            'encoding' => 'UTF-8',
            'Peter is a boy.',
            '[i',
        ],
    ];

    public $synopsis = 'bool mb_ereg_search_init ( string $string [, string $pattern [, string $option = &quot;msr&quot; ]] )';
    public $synopsis_fixed = null;
}
