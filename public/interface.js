/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

function change_language(select, current_language)
{
    var new_href = location.href.replace('/' + current_language + '/', '/' + select.value + '/');

    if (new_href == location.href) {
        // there is no change in case of the home page where the language is the last item without an ending "/"
        new_href = location.href.replace('/' + current_language, '/' + select.value);
    }

    location.assign(new_href);
}
function change_php_manual_location(select)
{
    var href = location.href;

    if (location.search) {
        // there are params, removes previous php manual location param if any
        href = href.split('php_manual_location')[0];

        if (href.substr(-1) != '?' && href.substr(-1) != '&') {
            // there is a single param, adds operator
            href += '&';
        }

    } else {
        href += '?';
    }

    location.assign(href + 'php_manual_location=' + select.value);
}

function run_function(url)
{
    var function_basename = document.getElementById('function').value;

    if (function_basename) {
        location.assign(url + '/' + function_basename);
    }
}

function set_php_manual_size(is_local_php_manual)
{
    var php_manual = document.getElementById('php_manual');

    if (php_manual) {
        var doc_style = window.getComputedStyle(document.body, null);
        var doc_margin_left = doc_style.getPropertyValue('margin-left').replace('px', '');
        var doc_margin_right = doc_style.getPropertyValue('margin-right').replace('px', '');
        var font_family = doc_style.getPropertyValue('font-family');

        var block = document.getElementsByClassName('block')[0];
        var input_style = window.getComputedStyle(block, null);
        var input_margin_right = input_style.getPropertyValue('margin-right').replace('px', '');
        var input_width = block.clientWidth;

        var scrollbar_thickness = 40;
        var adjustement = 20;

        // changes the php manual iframe width, note that it must be done before setting the page height
        php_manual.width = window.innerWidth - doc_margin_left - doc_margin_right - input_width - input_margin_right - adjustement;

        if (is_local_php_manual) {
            // this is the local php manual which can be manipulated as it is in the same domain
            // changes the php manual font (child doc), note that it must be done before setting the page height
            php_manual.contentWindow.document.body.style.fontFamily = font_family;
            php_manual.height = php_manual.contentWindow.document.body.scrollHeight + scrollbar_thickness;

        } else {
            // this is the php.net, sets an arbitrary fixed height that is oversized to contain most pages without displaying 2 scrollbars
            php_manual.height = 100000;
        }
    }
}
