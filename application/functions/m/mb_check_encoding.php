<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class mb_check_encoding extends function_core
{
    public $examples = [
        ['Hello world', 'ASCII'],
        ['está', 'ASCII']
    ];

    public $synopsis = 'bool mb_check_encoding ([ string $var = NULL [, string $encoding = mb_internal_encoding() ]] )';
}
