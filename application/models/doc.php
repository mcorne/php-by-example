<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';
require_once 'custom/pbx_text_to_html.php';

class doc extends action
{
    function process()
    {
        if (! $this->_application->doc_name) {
            return;
        }

        $directory = $this->_application->doc_name == 'sample' ? 'custom' : 'docs';
        $sub_path = sprintf('%s/%s.txt', $directory, $this->_application->doc_name);
        $filename = "$this->application_path/$sub_path";

        if (! file_exists($filename)) {
            $this->error = 'File not found: ' . $sub_path;
            return;
        }

        $text = file_get_contents($filename);

        if ($this->_application->doc_name != 'sample') {
            $text = $this->_output->remove_email_address($text);
        }

        if (isset($this->_application->uri[3]) and $this->_application->uri[3] == 'no_text_to_html') {
            $this->html = sprintf('<pre>%s</pre>', htmlspecialchars($text));

        } else {
            $this->html = pbx_text_to_html($text);
        }
    }
}
