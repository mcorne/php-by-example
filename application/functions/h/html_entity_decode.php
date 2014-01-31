<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class html_entity_decode extends function_core
{
    public $examples = ["I'll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now"];

    public $synopsis = 'string html_entity_decode ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; ]] )';
}
