<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'vsprintf.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class vprintf extends vsprintf
{
    public $output_buffer = true;
    
    public $synopsis = 'int vprintf ( string $format , array $args )';
}
