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

class getprotobyname extends function_core
{
    public $examples = ["tcp"];

    public $synopsis = 'int getprotobyname ( string $name )';

    function _get_options_list()
    {
        // see http://www.iana.org/assignments/protocol-numbers/protocol-numbers.xhtml
        foreach (range(0, 255) as $number) {
            if ($name = getprotobynumber($number)) {
                $names[] = $name;
            }
        }

        $options_list = isset($names) ? ['name' => $names] : [];

        return $options_list;
    }
}
