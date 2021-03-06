<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class grapheme_extract extends function_core
{
    public $constant_prefix = ['extract_type' => 'GRAPHEME'];

    public $examples = [
        [
            '_DOUBLE_QUOTES_a\xCC\x8Ao\xCC\x88_DOUBLE_QUOTES_',
            1,
            'GRAPHEME_EXTR_COUNT',
            2,
            '$next',
        ],
    ];

    public $source_code = '
        inject_function_call

        // shows the url encoded result
        $encoded = urlencode($string);
    ';

    public $synopsis = 'string grapheme_extract ( string $haystack , int $size [, int $extract_type [, int $start = 0 [, int &$next ]]] )';

    function post_exec_function()
    {
        $this->result['encoded'] = urlencode($this->result['string']);
    }
}
