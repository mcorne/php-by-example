<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

class pdo__query extends function_core
{
    public $examples = [
"
CREATE TABLE fruit (name, color, calories);
INSERT INTO fruit VALUES
    ('apple'     , 'red'   , 150),
    ('banana'    , 'yellow', 250),
    ('kiwi'      , 'brown' , 75),
    ('lemon'     , 'yellow', 25),
    ('orange'    , 'orange', 300),
    ('pear'      , 'green' , 150),
    ('watermelon', 'pink'  , 90);
SELECT name, color, calories FROM fruit ORDER BY name;
",
    ];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:");

        inject_function_call

        // shows the query result
        $rows = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    ';

    public $synopsis = 'public PDOStatement PDO::query ( string $statement )';

    function post_exec_function()
    {
        $statement = $this->result['PDOStatement'];
        $this->result['PDOStatement'] = get_class($statement);
        $this->result['rows'] = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function pre_exec_function()
    {
        $this->object = new PDO('sqlite::memory:');
    }
}
