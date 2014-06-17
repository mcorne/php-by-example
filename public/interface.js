/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

var prev_keynum;

function change_language(select, current_language)
{
    var new_href;
    var language_ending_url = new RegExp('/' + current_language + '/?$');
    var language_inside_url = new RegExp('/' + current_language + '/');
    
    if (language_inside_url.test(location.href)) {
        // eg "http://micmap.org/php-by-example/fr/function/abs"
        new_href = location.href.replace(language_inside_url, '/' + select.value + '/');
    
    } else if (language_ending_url.test(location.href)) {
        // eg "http://micmap.org/php-by-example/fr"
        new_href = location.href.replace(language_ending_url, '/' + select.value);
    
    } else {
        // eg "http://micmap.org/php-by-example"
        new_href = location.href + select.value;
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

function get_selected_text(id)
{
    var select = document.getElementById(id);
    var selectedIndex = select.selectedIndex;
    var options = select.options;
    var text = options[selectedIndex].text;
    
    return text;
}

function hide_arg_helper_select(arg_name)
{
    document.getElementById('textarea_'    + arg_name).style.display = 'inline';
    document.getElementById('helper_mark_' + arg_name).style.display = 'inline';

    document.getElementById('select_'        + arg_name).style.display = 'none';
    document.getElementById('helper_submit_' + arg_name).style.display = 'none';
}

function is_submit_enter_key(event)
{
    var is_submit_enter_key = false;

    if (! event) {
        event = window.event;
    }

    if (event.keyCode == 13 && prev_keynum != 38 && prev_keynum != 40) {
        // this is the enter key and the previous key was not the up or down key to select in the list
        is_submit_enter_key = true;
    }

    prev_keynum = event.keyCode;

    return is_submit_enter_key;
}

function open_php_manual_in_new_tab()
{
    var php_manual_new_tab = document.getElementById('php_manual_new_tab');
    
    if (php_manual_new_tab) {
        window.open(php_manual_new_tab.innerHTML, 'phpbexmanual');
    }
}

function run_searched_function(url)
{
    var function_name = document.getElementById('function_input').value;

    if (function_name) {
        location.assign(url + '/' + function_name);
    }
}

function run_selected_function(url)
{
    var select = document.getElementById('function_select');
    var function_name = select.options[select.selectedIndex].text;

    if (function_name) {
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

function set_function_input(function_name)
{
    var datalist = document.getElementById('function_list');

    if ('options' in datalist) {
        // the browser implements the datalist, sets the data list
        datalist.innerHTML = function_list;
    }

    if (function_name) {
        document.getElementById('function_input').value = function_name;
    }
}

function set_function_select(function_name, select_class)
{
    var select = document.getElementById('function_select');
    // captures the default option
    var default_option = select.options[0].text;
    // captures the on key down even
    var onkeydown = select.onkeydown;
    // gets the select placeholder that is necessary to recreate the select with its options inside
    // because creating the options only by setting the select innerHTML does not work some browsers (versions), eg IE 8
    var placeholder = document.getElementById('function_select_placeholder');

    placeholder.innerHTML = '<select class="' + select_class + '" id="function_select"><option value="">' + default_option + '</option>' + function_list + '</select>';
    // restores the key down event to the new select
    document.getElementById('function_select').onkeydown = onkeydown;

    if (function_name) {
        set_selected_value('function_select', function_name);
    }
}

function set_lastest_version_in_production()
{
    var translation_lastest_version = get_selected_text('select_translation_lastest_version');
    var translation_in_production   = get_selected_text('select_translation_in_production');
    
    var display_in_production     = document.getElementById('display_in_production');
    var display_not_in_production = document.getElementById('display_not_in_production');

    if (! translation_lastest_version || ! translation_in_production) {
        display_in_production.style.display     = 'none';
        display_not_in_production.style.display = 'none';

    } else if (translation_lastest_version == translation_in_production) {
        display_in_production.style.display     = 'inline';
        display_not_in_production.style.display = 'none';

    } else {
        display_in_production.style.display     = 'none';
        display_not_in_production.style.display = 'inline';
    }
}

function set_php_manual_size()
{
    var php_manual = document.getElementById('php_manual');
    var adjustement, block, doc_margin_left, doc_style, doc_margin_right, font_family, innerWidth, input_margin_right, input_style, input_width, scrollbar_thickness;

    if (! php_manual) {
        return;
    }
    
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
        block = document.getElementsByClassName('block')[0];                                                                                     
        input_style = window.getComputedStyle(block, null);                                                                                      
        input_margin_right = input_style.getPropertyValue('margin-right').replace('px', '');                                                     
                                                                                                                                             
    } else {                                                                                                                                     
        // for older versions of IE                                                                                                              
        block = document.querySelectorAll('.' + 'block')[0];                                                                                     
        input_margin_right = 10;                                                                                                                 
    }                                                                                                                                            
                                                                                                                                             
    input_width = block.clientWidth;                                                                                                             
    scrollbar_thickness = 40;                                                                                                                    
    adjustement = 20;                                                                                                                            
                                                                                                                                             
    if ( window.innerWidth) {                                                                                                                    
        innerWidth = window.innerWidth;                                                                                                          
    } else {                                                                                                                                     
        innerWidth = document.documentElement.clientWidth;                                                                                       
    }                                                                                                                                            
                                                                                                                                             
    // changes the php manual iframe width, note that it must be done before setting the page height                                             
    php_manual.width = innerWidth - doc_margin_left - doc_margin_right - input_width - input_margin_right - adjustement;                         
                                                                                                                                             
    // changes the php manual font (child doc), note that it must be done before setting the page height                                         
    php_manual.contentWindow.document.body.style.fontFamily = font_family;                                                                       
    php_manual.height = php_manual.contentWindow.document.body.scrollHeight + scrollbar_thickness;                                               
}

function set_selected_value(id, selected)
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

function set_translation_selects(id1, id2, selected)
{
    set_selected_value(id1, selected);
    set_selected_value(id2, selected);
    set_lastest_version_in_production();
}
