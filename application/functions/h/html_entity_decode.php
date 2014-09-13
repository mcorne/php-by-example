<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class html_entity_decode extends function_core
{
    public $examples = [
        "I'll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now",
        [
            '_DOUBLE_QUOTES_l&quot;\xe0&quot; is not &quot;a&quot;_DOUBLE_QUOTES_', // "à" in ISO
            "ENT_COMPAT",
            "ISO-8859-1",
        ],
    ];

    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $synopsis = 'string html_entity_decode ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; ]] )';

    public $source_code = '
inject_function_call

// enter non ASCII characters in hex in $_string if $_encoding is not UTF-8
// the returned $_string may not display properly if $_encoding is not UTF-8

// shows the returned $string in UTF-8 if $_encoding is not UTF-8
if ($_encoding and $_encoding != "UTF-8")
    $utf8 = mb_convert_encoding($_string, "UTF-8", $_encoding);
';

    function post_exec_function()
    {
         $encoding = $this->_filter->filter_arg_value('encoding');

         if ($encoding and $encoding != 'UTF-8') {
             $string = $this->result['string'];
             $this->result['utf8'] = mb_convert_encoding($string, "UTF-8", $encoding);
         }
    }
}
