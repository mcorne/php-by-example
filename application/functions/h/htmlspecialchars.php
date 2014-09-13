<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'html_entity_decode.php';

class htmlspecialchars extends html_entity_decode
{
    public $examples = [
        [
            "<a href='test'>Test</a>",
            'ENT_QUOTES',
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

    public $synopsis = 'string htmlspecialchars ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; [, bool $double_encode = true ]]] )';
}
