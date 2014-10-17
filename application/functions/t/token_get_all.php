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

class token_get_all extends function_core
{
    public $examples = ["<?php echo; ?>", '/* comment */'];

    public $synopsis = 'array token_get_all ( string $source )';

    public $test_not_validated = true;
}
