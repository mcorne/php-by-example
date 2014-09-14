<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class version_compare extends function_core
{
    public $examples = [
        [
            'PHP_VERSION',
            '6.0.0'
        ],
        [
            'PHP_VERSION',
            '5.3.0'
        ],
        [
            'PHP_VERSION',
            "5.0.0",
            ">="
        ],
        [
            'PHP_VERSION',
            "5.0.0",
            "<"
        ]
    ];

    public $options_list = ['operator' => ['<', 'lt', '<=', 'le', '>', 'gt', '>=', 'ge', '==', '=', 'eq', '!=', '<>', 'ne']];

    public $synopsis = 'mixed version_compare ( string $version1 , string $version2 [, string $operator ] )';

    public $test_not_validated = true;
}
