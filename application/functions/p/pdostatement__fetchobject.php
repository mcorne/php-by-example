<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/p/pdostatement__fetch.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pdostatement__fetchobject extends pdostatement__fetch
{
    public $examples = [
        [
            'exec_statement' =>
                "CREATE TABLE fruit
                    (name, colour, calories INT);

                INSERT INTO fruit VALUES
                    ('apple', 'red', 150),
                    ('banana', 'yellow', 250),
                    ('kiwi', 'brown', 75),
                    ('lemon', 'yellow', 25),
                    ('orange', 'orange', 300),
                    ('pear', 'green', 150),
                    ('watermelon', 'pink', 90)",
            'statement'      => "SELECT name, colour, calories FROM fruit",
            'StdClass',
        ],
    ];

    public $synopsis = 'public mixed PDOStatement::fetchObject ([ string $class_name = &quot;stdClass&quot; [, array $ctor_args ]] )';
}
