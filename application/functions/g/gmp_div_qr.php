<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_abs.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class gmp_div_qr extends gmp_abs
{
    public $examples = [
        ["0x41682179fbf5", "0xDEFE75"],
        [25, 3],
    ];

    public $synopsis = 'array gmp_div_qr ( resource $n , resource $d [, int $round = GMP_ROUND_ZERO ] )';

    function post_exec_function()
    {
        if (is_array($this->result['array'])) {
            $this->result['string'] = array_map('gmp_strval', $this->result['array']);
        }
    }
}
