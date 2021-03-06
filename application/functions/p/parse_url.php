<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class parse_url extends function_core
{

    public $constant_prefix = ['component' => 'PHP_URL'];

    public $examples = [
        "http://username:password@hostname/path?arg=value#anchor",
        ["http://username:password@hostname/path?arg=value#anchor", 'PHP_URL_PATH'],
        "//www.example.com/path?googleguy=googley",
    ];

    public $synopsis = 'mixed parse_url ( string $url [, int $component = -1 ] )';
}
