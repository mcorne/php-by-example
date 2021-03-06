<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class money_format extends function_core
{
    public $examples = [
        [
            'locale' => 'en_US',
            "%i",
            -1234.5672
        ],
        [
            'locale' => 'it_IT',
            "%.2n",
            -1234.5672
        ],
        [
            'locale' => 'en_US',
            "%(#10n",
            -1234.5672
        ],
        [
            'locale' => 'en_US',
            "%=*(#10.2n",
            -1234.5672
        ],
        [
            'locale' => 'de_DE',
            "%=*^-14#8.2i",
            1234.56
        ],
        [
            'locale' => 'en_GB',
            "The final value is %i (after a 10%% discount)",
            1234.56
        ]
    ];

    public $source_code = '
        $string = setlocale (
            LC_MONETARY, // int $category
            $locale // string $locale
        );

        inject_function_call
    ';

    public $synopsis = 'string money_format ( string $format , float $number )';

    public $test_not_validated = true;

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->returned_params['string'] = setlocale(LC_MONETARY, $locale);
    }
}
