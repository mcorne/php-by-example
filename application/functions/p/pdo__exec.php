<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pdo__exec extends function_core
{
    public $examples = [
        [
            "CREATE TABLE fruit
                (name, color, calories);

            INSERT INTO fruit VALUES
                ('apple', 'red', 150),
                ('banana', 'yellow', 250),
                ('kiwi', 'brown', 75),
                ('lemon', 'yellow', 25),
                ('orange', 'orange', 300),
                ('pear', 'green', 150),
                ('watermelon', 'pink', 90)",
        ],
        [
            "CREATE TABLE fruit
                (name, color, calories);

            INSERT INTO fruit VALUES
                ('apple', 'red', 150),
                ('banana', 'yellow', 250);

            UPDATE fruit
            SET name = 'pear'
            WHERE name = 'apple'",
        ],
        [
            "CREATE TABLE bad ()",
        ],
    ];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        inject_function_call
    ';

    public $synopsis = 'public int PDO::exec ( string $statement )';

    function pre_exec_function()
    {
        $this->object = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}
