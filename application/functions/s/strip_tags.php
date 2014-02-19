<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
