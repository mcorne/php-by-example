<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class get_html_translation_table extends function_core
{
    public $examples = [
        ['HTML_ENTITIES', 'ENT_QUOTES | ENT_HTML5']
    ];

    public $synopsis = 'array get_html_translation_table ([ int $table = HTML_SPECIALCHARS [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; ]]] )';
}
