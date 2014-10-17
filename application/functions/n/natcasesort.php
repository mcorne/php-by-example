<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/a/array_pop.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class natcasesort extends array_pop
{
    public $examples = [
        [
            '__array' => ['IMG0.png', 'img12.png', 'img10.png', 'img2.png', 'img1.png', 'IMG3.png'],
            '$array',
        ],
    ];

    public $synopsis = 'bool natcasesort ( array &$array )';
}
