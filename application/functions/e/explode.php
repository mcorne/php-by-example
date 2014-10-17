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

class explode extends function_core
{
    public $examples = [
        [" ", "piece1 piece2 piece3 piece4 piece5 piece6"],
        [":", "foo:*:1023:1000::/home/foo:/bin/sh"],
        ["|", "one|two|three|four", 2]
    ];

    public $synopsis = 'array explode ( string $delimiter , string $string [, int $limit ] )';
}
