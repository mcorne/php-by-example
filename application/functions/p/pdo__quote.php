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

class pdo__quote extends function_core
{
    public $examples = [
        'Nice',
        'Naughty \' string',
        "Co'mpl''ex \"st'\"ring",
    ];

    public $synopsis = 'public string PDO::quote ( string $string [, int $parameter_type = PDO::PARAM_STR ] )';

    function pre_exec_function()
    {
        $this->result['pdo'] = $this->object = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}
