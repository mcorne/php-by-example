<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class normalizer__isnormalized extends function_core
{
    public $constant_prefix = ['form' => 'Normalizer::FORM'];

    public $examples = [
        [
            '_DOUBLE_QUOTES_A\xCC\x8A_DOUBLE_QUOTES_',
            'Normalizer::FORM_C',
        ],
        [
            "Å",
            'Normalizer::FORM_C',
        ],
    ];

    public $synopsis = 'public static bool Normalizer::isNormalized ( string $input [, string $form = Normalizer::FORM_C ] )';
}
