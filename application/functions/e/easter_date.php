<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/m/mktime.php';

class easter_date extends mktime
{    public $examples = [1999, 2000, 2001];

    public $synopsis_fixed = 'int easter_date ([ int $year ] )';
}
