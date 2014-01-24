<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class bindec extends function_core
{
    public $examples = [
        ['110011'],
        ['000110011'],
        ['111'],
    ];

    public $synopsis = 'number bindec ( string $binary_string )';
}
