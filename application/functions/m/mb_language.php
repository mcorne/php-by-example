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

class mb_language extends function_core
{
    public $options_list = ['language' => ["en", "English", "ja", "Japanese", "uni"]];

    public $synopsis = 'mixed mb_language ([ string $language = mb_language() ] )';

    public $test_not_validated = true;
}
