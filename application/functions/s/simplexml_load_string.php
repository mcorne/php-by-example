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
 * @see docs/function-configuration.txt
 */

class simplexml_load_string extends function_core
{
    public $constant_prefix = ['options' => 'LIBXML'];

    public $examples = [
        "<?xml version='1.0'?>
        <document>
         <title>Forty What?</title>
         <from>Joe</from>
         <to>Jane</to>
         <body>
          I know that's the answer -- but what's the question?
         </body>
        </document>"
    ];

    public $options_list = ['class_name' => ['SimpleXMLElement']];

    public $source_code = '
        inject_function_call

        // shows the xml object
        $string = print_r($SimpleXMLElement, true);
    ';

    public $synopsis = 'SimpleXMLElement simplexml_load_string ( string $data [, string $class_name = &quot;SimpleXMLElement&quot; [, int $options = 0 [, string $ns = &quot;&quot; [, bool $is_prefix = false ]]]] )';

    function post_exec_function()
    {
        $this->result['string'] = print_r($this->result['SimpleXMLElement'], true);
    }
}
