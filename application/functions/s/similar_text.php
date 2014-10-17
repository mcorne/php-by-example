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

class similar_text extends function_core
{
    public $examples = [
        [
            'PHP IS GREAT',
            'WITH MYSQL',
            '$percent',
        ],
        [
            'WITH MYSQL',
            'PHP IS GREAT',
            '$percent',
        ],
    ];

    public $synopsis = 'int similar_text ( string $first , string $second [, float &$percent ] )';
}
