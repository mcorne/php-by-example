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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class filter_var extends function_core
{
    public $examples = [
        [
            "0755",
            "FILTER_VALIDATE_INT",
            [
                "options" => [
                    "default" => 3,
                    "min_range" => 0,
                ],
                "flags" => "FILTER_FLAG_ALLOW_OCTAL",
            ]
        ],
        [
            "oops",
            "FILTER_VALIDATE_BOOLEAN",
            "FILTER_NULL_ON_FAILURE"
        ],
        [
            "oops",
            "FILTER_VALIDATE_BOOLEAN",
            [
                "flags" => "FILTER_NULL_ON_FAILURE",
            ]
        ],
        [
            "Doe, Jane Sue",
            "FILTER_CALLBACK",
            [
                "options" => "foo",
            ]
        ],
        [
            "bob@example.com",
            "FILTER_VALIDATE_EMAIL"
        ],
        [
            "http://example.com",
            "FILTER_VALIDATE_URL",
            "FILTER_FLAG_PATH_REQUIRED"
        ],
        [
            "127.0.0.1",
            "FILTER_VALIDATE_IP"
        ],
        [
            "1",
            "FILTER_VALIDATE_INT",
            [
                "options" => [
                    "default" => 3,
                    "min_range" => 0,
                ],
            ]
        ],
        [
            "-1",
            "FILTER_VALIDATE_INT",
            [
                "options" => [
                    "default" => 3,
                    "min_range" => 0,
                ],
            ]
        ],
        [
            "4",
            "FILTER_VALIDATE_INT",
            [
                "options" => [
                    "default" => 3,
                    "min_range" => 0,
                ],
            ]
        ],
        [
            "(bob@example.com)",
            "FILTER_SANITIZE_EMAIL",
        ],
        [
            "Doe Jane Sue",
            "FILTER_CALLBACK",
            [
                "options" => "foo",
            ]
        ],
        [
            "bogus",
            "FILTER_VALIDATE_EMAIL"
        ],
        [
            "42.42",
            "FILTER_VALIDATE_IP"
        ],
        [
            3,
            "FILTER_CALLBACK",
            [
                "options" => "cube",
            ]
        ],
        [
            3,
            "FILTER_CALLBACK",
            [
                "options" => '$cube',
            ]
        ],
        [
            3,
            "FILTER_CALLBACK",
            [
                "options" => "pbx_callbacks::cube",
            ]
        ],
        [
            3,
            "FILTER_CALLBACK",
            [
                "options" => ['$object', 'cube'],
            ]
        ],
    ];

    public $source_code = '
        // custom callback functions
        function cube($n)    { return($n * $n * $n); }
        function foo($value) {
            if (strpos($value, ", ") === false) // expected format: Surname, GivenNames
                return false;

            list($surname, $givennames) = explode(", ", $value, 2);
            $empty = (empty($surname) || empty($givennames));
            $notstrings = (!is_string($surname) || !is_string($givennames));

            if ($empty || $notstrings) {
                return false;
            } else {
                return $value;
            }
        }

        // adds custom callback functions, closures and methods
        require "pbx_callbacks.php";
        $object = new pbx_callbacks();

        inject_function_call
    ';

    public $synopsis = 'mixed filter_var ( mixed $variable [, int $filter = FILTER_DEFAULT [, mixed $options ]] )';

    function pre_exec_function()
    {
        $filter = $this->_filter->filter_arg_value('filter');
        $options = $this->_filter->filter_arg_value('options');

        if ($filter == FILTER_CALLBACK and isset($options['options'])) {
            // there is a callback, adds a callback param
            $this->_function_params->set_param('callback', $options['options']);
            // updates the callback in case an object or a closuse is returned
            $options['options'] = $this->_filter->filter_callback('callback');
            $this->returned_params['options'] = $options;
        }
    }
}
