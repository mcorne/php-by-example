<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class json_decode extends function_core
{
    public $examples = [
        "{\"a\":1,\"b\":2,\"c\":3,\"d\":4,\"e\":5}",
        ["{\"a\":1,\"b\":2,\"c\":3,\"d\":4,\"e\":5}", "true"],
        "{\"foo-bar\": 12345}",
        "{ bar: 'baz', }",
        "{ 'bar': \"baz\", }",
        "{ bar: \"baz\", }",
        '{"1":{"English":["One","January"],"French":["Une","Janvier"]}}',
        "{\"number\": 12345678901234567890}",
        ["{\"number\": 12345678901234567890}", "false", 512, 'JSON_BIGINT_AS_STRING']
    ];

    public $synopsis = 'mixed json_decode ( string $json [, bool $assoc = false [, int $depth = 512 [, int $options = 0 ]]] )';
}
