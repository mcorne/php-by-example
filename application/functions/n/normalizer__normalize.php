<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'normalizer__isnormalized.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class normalizer__normalize extends normalizer__isnormalized
{
    public $synopsis = 'public static string Normalizer::normalize ( string $input [, string $form = Normalizer::FORM_C ] )';
}
