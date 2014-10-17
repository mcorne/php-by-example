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

class setlocale extends function_core
{
    public $constant_prefix = ['category' => 'LC'];

    public $examples = [
        ['LC_ALL', "nl_NL"],
        ['LC_ALL', 'de_DE@euro', 'de_DE', 'de', 'ge'],
        ['LC_ALL', "nld_nld"],
        ['LC_ALL', 'de_DE@euro', 'de_DE', 'deu_deu']
    ];

    public $synopsis       = 'string setlocale ( int $category , string $locale [, string $... ] )';
    public $synopsis_fixed = 'string setlocale ( int $category , string $locale , string $locale1 , string $locale2, string $locale3 [, string $... ] )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        setlocale(LC_ALL, $this->local);
    }

    function pre_exec_function()
    {
        $this->local = setlocale(LC_ALL, 0);
    }
}
