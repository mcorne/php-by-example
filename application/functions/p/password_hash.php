<?php
/**
 * PHP By Example
 *
 * @copyright 2017 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class password_hash extends function_core
{
    public $constant_prefix = ['algo' => 'PASSWORD'];

    public $examples = [
        [
            "rasmuslerdorf",
            "PASSWORD_DEFAULT"
        ],
        [
            "rasmuslerdorf",
            "PASSWORD_BCRYPT",
            [
                "cost" => 12,
            ]
        ],
        [
            "test",
            "PASSWORD_BCRYPT",
            [
                "cost" => 8,
            ]
        ]
    ];

    public $synopsis = 'string password_hash ( string $password , integer $algo [, array $options ] )';

    public $test_not_validated = true;
}
