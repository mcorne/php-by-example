<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator__getsortkey.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class collator_get_sort_key extends collator__getsortkey
{
    public $manual_function_name = 'Collator::getSortKey';

}
