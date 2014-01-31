<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class gmp_clrbit extends function_core
{
    public $source_code = '
$_a = gmp_init(
    $number, // mixed $number
    $base // [int $base = 0]
);
inject_function_call
$string = gmp_strval($a, 2);
';

    public $examples = [
        [
            'number' => "0xff",
            '$a',
            0
        ],
    ];

    public $synopsis = 'void gmp_clrbit ( resource $a , int $index )';

    function post_exec_function()
    {
        $this->result['string'] = gmp_strval($this->returned_params['a'], 2);
    }

    function pre_exec_function()
    {
        $number = $this->_filter->filter_param('number');
        $this->returned_params['a'] = gmp_init($number);
    }
}
