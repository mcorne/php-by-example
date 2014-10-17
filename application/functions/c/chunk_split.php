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

class chunk_split extends function_core
{
    public $examples = [
        ['00000111112222233333', 5, '_DOUBLE_QUOTES_\n_DOUBLE_QUOTES_']
    ];

    public $synopsis = 'string chunk_split ( string $body [, int $chunklen = 76 [, string $end = &quot;\r\n&quot; ]] )';
}
