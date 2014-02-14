<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
