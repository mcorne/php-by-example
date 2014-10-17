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

class get_html_translation_table extends function_core
{
    public $examples = [
        ['HTML_ENTITIES', 'ENT_QUOTES | ENT_HTML5']
    ];

    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $synopsis = 'array get_html_translation_table ([ int $table = HTML_SPECIALCHARS [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; ]]] )';

    public $test_not_validated = true;
}
