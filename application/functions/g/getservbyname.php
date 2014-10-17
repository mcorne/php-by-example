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

class getservbyname extends function_core
{
    public $examples = [
        ["http", "tcp"]
    ];

    public $synopsis = 'int getservbyname ( string $service , string $protocol )';

    function _get_options_list()
    {
        $options_list['protocol'] = ['tcp', 'udp'];

        // see http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
        // only displaying a subset as there are thousands
        foreach (range(0, 255) as $port) { // note the
            if ($name = getservbyport($port, 'udp') or $name = getservbyport($port, 'tcp')) {
                $names[] = $name;
            }
        }

        if (isset($names)) {
            $options_list['service'] = $names;
        }

        return $options_list;
    }
}
