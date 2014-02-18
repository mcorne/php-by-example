<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class nl2br extends function_core
{
    public $examples = [
        '_DOUBLE_QUOTES_foo isn\'t\n bar_DOUBLE_QUOTES_',
        [
            '_DOUBLE_QUOTES_Welcome\r\nThis is my HTML document_DOUBLE_QUOTES_',
            false
        ],
        '_DOUBLE_QUOTES_This\r\nis\n\ra\nstring\r_DOUBLE_QUOTES_'
    ];

    public $synopsis = 'string nl2br ( string $string [, bool $is_xhtml = true ] )';

    public $test_not_validated = [1, 2];
}
