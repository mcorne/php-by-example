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

class abs extends function_core
{
    public $examples = [
        -4.2,
        5,
        // used in translations_in_action.php
        -5,
        '_SINGLE_QUOTE_abc',
        '_NO_CHANGE_["abc" => 123',
        '_NO_CHANGE_xyz',
        '_NO_CHANGE_E_ERROR|123',
        "_NO_CHANGE_-'sdf'",
        '_NO_CHANGE_123 456',
        null, // placeholder, see below
    ];

    public $synopsis = 'number abs ( mixed $number )';

    function init()
    {
        $this->examples[9] = str_repeat('a', 1000 + 1);
    }
}
