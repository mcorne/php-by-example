<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class chunk_split extends function_core
{
    public $examples = [
        ['00000111112222233333', 5, '_DOUBLE_QUOTES_\n_DOUBLE_QUOTES_']
    ];

    public $synopsis = 'string chunk_split ( string $body [, int $chunklen = 76 [, string $end = &quot;\r\n&quot; ]] )';
}
