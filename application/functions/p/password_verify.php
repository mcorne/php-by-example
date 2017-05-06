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

class password_verify extends function_core
{
    public $examples = [
        [
            "rasmuslerdorf",
            '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq'
        ]
    ];

    public $synopsis = 'boolean password_verify ( string $password , string $hash )';
}
