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

function display_arg_helper_select(arg_name)
{   
    document.getElementById('textarea_'    + arg_name).style.display = 'none';
    document.getElementById('helper_mark_' + arg_name).style.display = 'none';
    
    document.getElementById('select_'        + arg_name).style.display = 'inline';
    document.getElementById('helper_submit_' + arg_name).style.display = 'inline';
}

function hide_arg_helper_select(arg_name)
{   
    document.getElementById('textarea_'    + arg_name).style.display = 'inline';
    document.getElementById('helper_mark_' + arg_name).style.display = 'inline';
    
    document.getElementById('select_'        + arg_name).style.display = 'none';
    document.getElementById('helper_submit_' + arg_name).style.display = 'none';
}

function is_enter_key(keyEvent)
{
    var keynum;

    if (window.event) { // IE
        keynum = keyEvent.keyCode;
    
    } else if (keyEvent.which) { // Netscape/Firefox/Opera
        keynum = keyEvent.which;
    }

    return (keynum === 13);
}

function run_function(url, direction)
{
    var datalist = document.getElementById('function_list');
    var function_name;
    
    if ('options' in datalist) {
        // the browser implements the datalist, gets the function basebame from the input field
        function_name = document.getElementById('function_input').value;
    } else {
        // the browser does not implement the datalist, gets the function basebame from the select box
        function_name = document.getElementById('function_select').value;
    }

    if (function_name) {
        if (direction) {
            function_name += '/' + direction;
        }
        
        location.assign(url + '/' + function_name);
    }
}

function set_arg_value(arg_name)
{  
    var select = document.getElementById('select_' + arg_name);
    var options = '';
    
    for (i = 0; i < select.length; i++) {
        if (! i || ! select[i].selected) {
            continue;
        }
        
        if (options) {
            options += ' | ' + select[i].value;
        } else {
            options = select[i].value;
        }
    }
    
    document.getElementById('textarea_' + arg_name).value = options;

    hide_arg_helper_select(arg_name);
}

function set_function_list(function_name)
{
    var datalist = document.getElementById('function_list');
    var placeholder = document.getElementById('function_select_placeholder');
    var function_input = document.getElementById('function_input');
    
    if ('options' in datalist) { 
        // the browser implements the datalist, sets the data list
        datalist.innerHTML = function_list;
        
        if (function_name) {
            function_input.value = function_name;
        }
                
    } else {
       // the browser does not implement the datalist, hides the data list, displays and sets the select box
        function_input.style.display = 'none';
        placeholder.style.display = 'inline';
        placeholder.innerHTML = '<select id="function_select"><option></option>' + function_list + '</select>';
        
        if (function_name) {
            set_select_value('function_select', function_name);
        }
    }
}

function set_php_manual_size(is_local_php_manual)
{
    var php_manual = document.getElementById('php_manual');
    var doc_style;
    var doc_margin_left;
    var doc_margin_right;
    var font_family;

    if (php_manual) {
        if (window.getComputedStyle) {
            doc_style = window.getComputedStyle(document.body, null);
            doc_margin_left = doc_style.getPropertyValue('margin-left').replace('px', '');
            doc_margin_right = doc_style.getPropertyValue('margin-right').replace('px', '');
            font_family = doc_style.getPropertyValue('font-family');
        
        } else {
            // for older versions of IE
            doc_style = document.body.currentStyle;
            doc_margin_left = 10;
            doc_margin_right = 10;
            font_family = doc_style.fontFamily;
        }
        
        if (document.getElementsByClassName) {
            var block = document.getElementsByClassName('block')[0];
            var input_style = window.getComputedStyle(block, null);
            var input_margin_right = input_style.getPropertyValue('margin-right').replace('px', '');
       
        } else {
            var block = document.querySelectorAll('.' + 'block')[0];
            var input_margin_right = 10;
        }
        
        var input_width = block.clientWidth;

        var scrollbar_thickness = 40;
        var adjustement = 20;
        
        if ( window.innerWidth) {
            var innerWidth = window.innerWidth;
        } else {
            var innerWidth = document.documentElement.clientWidth;
        }

        // changes the php manual iframe width, note that it must be done before setting the page height
        php_manual.width = innerWidth - doc_margin_left - doc_margin_right - input_width - input_margin_right - adjustement;

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

function set_select_value(id, selected)
{
    var select = document.getElementById(id);
    var i;
                   
    for (i = 0; i < select.options.length; i++) {
        if (select.options[i].value == selected) {
            select.options[i].selected = true;
            break;
        }
    }
}
