<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class htmlentities extends function_core
{
    public $examples = [
        "A 'quote' is <b>bold</b>",
        [
            "A 'quote' is <b>bold</b>",
            'ENT_QUOTES',
        ],
        [
            '_DOUBLE_QUOTES_\x8F!!!_DOUBLE_QUOTES_',
            'ENT_QUOTES',
            "UTF-8",
        ],
        [
            '_DOUBLE_QUOTES_\x8F!!!_DOUBLE_QUOTES_',
            'ENT_QUOTES | ENT_IGNORE',
            "UTF-8",
        ],
        [
            '_DOUBLE_QUOTES_\'à\' is not \'a\'_DOUBLE_QUOTES_',
            "ENT_QUOTES",
        ],
        [
            '_DOUBLE_QUOTES_\'\xe0\' is not \'a\'_DOUBLE_QUOTES_', // "à" in ISO
            "ENT_QUOTES",
            "ISO-8859-1",
        ],
    ];

    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $source_code = '
inject_function_call

// enter non ASCII characters in hex in $_string if $_encoding is not UTF-8
';

    public $synopsis = 'string htmlentities ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; [, bool $double_encode = true ]]] )';
}
