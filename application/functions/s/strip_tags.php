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

class strip_tags extends function_core
{
    public $examples = [
        "<p>Test paragraph.</p><!-- Comment --> <a href=\"#fragment\">Other text</a>",
        [
            "<p>Test paragraph.</p><!-- Comment --> <a href=\"#fragment\">Other text</a>",
            "<p><a>"
        ]
    ];

    public $synopsis = 'string strip_tags ( string $str [, string $allowable_tags ] )';
}
