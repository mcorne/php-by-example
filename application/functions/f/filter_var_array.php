<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class filter_var_array extends function_core
{
    public $examples = [
        [
            [
                "product_id" => "libgd<script>",
                "component" => "10",
                "versions" => "2.0.33",
                "testscalar" => [
                    0 => "2",
                    1 => "23",
                    2 => "10",
                    3 => "12",
                ],
                "testarray" => "2",
            ],
            [
                "product_id" => "FILTER_SANITIZE_ENCODED",
                "component" => [
                    "filter" => "FILTER_VALIDATE_INT",
                    "flags" => "FILTER_FORCE_ARRAY",
                    "options" => [
                        "min_range" => 1,
                        "max_range" => 10,
                    ],
                ],
                "versions" => "FILTER_SANITIZE_ENCODED",
                "doesnotexist" => "FILTER_VALIDATE_INT",
                "testscalar" => [
                    "filter" => "FILTER_VALIDATE_INT",
                    "flags" => "FILTER_REQUIRE_SCALAR",
                ],
                "testarray" => [
                    "filter" => "FILTER_VALIDATE_INT",
                    "flags" => "FILTER_FORCE_ARRAY",
                ],
            ]
        ]
    ];

    public $synopsis = 'mixed filter_var_array ( array $data [, mixed $definition [, bool $add_empty = true ]] )';
}
