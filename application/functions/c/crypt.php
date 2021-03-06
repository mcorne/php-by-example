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

class crypt extends function_core
{
    public $examples = [
        ["rasmuslerdorf", "rl"],
        ["rasmuslerdorf", "_J9..rasm"],
        ["rasmuslerdorf", '$1$rasmusle$'],
        ["rasmuslerdorf", '$2a$07$usesomesillystringforsalt$'],
        ["rasmuslerdorf", '$5$rounds=5000$usesomesillystringforsalt$'],
        ["rasmuslerdorf", '$6$rounds=5000$usesomesillystringforsalt$']
    ];

    public $synopsis = 'string crypt ( string $str [, string $salt ] )';
}
