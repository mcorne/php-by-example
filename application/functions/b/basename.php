<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class basename extends function_core
{
    public $examples = [
        ["/etc/sudoers.d", ".d"],
        ["/etc/passwd"],
        ["/etc/"],
        ["."],
        ["/"],
    ];

    public $synopsis = 'string basename ( string $path [, string $suffix ] )';
}
