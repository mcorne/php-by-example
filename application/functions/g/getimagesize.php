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
 * @see docs/function-configuration.txt
 */

class getimagesize extends function_core
{
    public $examples = [
        'logo.gif',
        'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Wikipedia-logo-v2-en.png/120px-Wikipedia-logo-v2-en.png',
        'http://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Wiktionary-logo.svg/370px-Wiktionary-logo.svg.png',
    ];

    public $synopsis = 'array getimagesize ( string $filename [, array &$imageinfo ] )';

    public $test_not_to_run = [1, 2];

    function init()
    {
        $this->examples[0] = $this->public_path . '/' . $this->examples[0];
    }
}
