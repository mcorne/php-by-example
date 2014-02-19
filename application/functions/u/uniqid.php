<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class uniqid extends function_core
{
    public $examples = [
        [],
        'php_',
        ['', true],
    ];

    public $synopsis = 'string uniqid ([ string $prefix = &quot;&quot; [, bool $more_entropy = false ]] )';

    public $test_not_validated = true;
}
