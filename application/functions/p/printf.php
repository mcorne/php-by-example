<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/s/sprintf.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class printf extends sprintf
{
    public $output_buffer = true;

    public $synopsis = 'int printf ( string $format [, mixed $args [, mixed $... ]] )';
    public $synopsis_fixed = 'string printf ( string $format , mixed $arg0 , mixed $arg1 , mixed $arg2 [, mixed $... ] )';
}
