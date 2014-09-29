<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * Custom functions and methods used for callbacks in examples
 *
 * a callback may be done in 4 ways:
 *
 * a call to a function      : $result = call_user_func("barber", "shave");
 *
 * a call to a closure       : $result = call_user_func($barber, "shave");
 *
 * a call to a static method : $result = call_user_func(["pbx_callbacks", "barber"], "shave");
 *                             $result = call_user_func(["pbx_callbacks::barber"]  , "shave");
 *
 * a call to an objet method : $object = new pbx_callbacks();
 *                             $result = call_user_func([$object, "barber"], "shave");
 *
 * note that all functions and closures must have a corresponding method so they can be elligible to run
 * see filter::is_custom_callback_function()
 */

/**
 * List of all custom functions used for callbacks
 */

function barber($type) {
    return "You wanted a $type haircut, no problem";
}

function cb1($a) {
    return array ($a);
}

function cb2($a, $b) {
    return array ($a, $b);
}

function compare_func($a, $b) {
    if ($a === $b) {
        return 0;
    }
    return ($a > $b)? 1 : -1;
}

function cube($n) {
    return($n * $n * $n);
}

function double($value) {
    return $value * 2;
}

function even($var) {
    return(!($var & 1));
}

function foo($value)
{
    // Expected format: Surname, GivenNames
    if (strpos($value, ", ") === false)
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

function foobar($arg, $arg2) {
    return "foobar got $arg and $arg2";
}

function map_Spanish($n, $m) {
    return(array($n => $m));
}

function next_year($matches) {
    return $matches[1] . ($matches[2] + 1);
}

function odd($var) {
    return($var & 1);
}

function rmul($v, $w) {
    $v *= $w;
    return $v;
}

function rsum($v, $w) {
    $v += $w;
    return $v;
}

function say_goodbye($name) {
    return "Goodbye $name!";
}

function say_hello() {
    return "Hello!";
}

function show_Spanish($n, $m) {
    return("The number $n is called $m in Spanish");
}

function test_alter(&$item1, $key, $prefix) {
    $item1 = "$prefix: $item1";
 }

function test_print(&$item, $key) {
    $item = "$key holds $item\n";
 }

function to_lower($matches) {
    return strtolower($matches[0]);
}

/**
 * List of all closures used for callbacks
 */

$GLOBALS['barber'] = function ($type) {
    return "You wanted a $type haircut, no problem";
};

$GLOBALS['cb1'] = function ($a) {
    return array ($a);
};

$GLOBALS['cb2'] = function ($a, $b) {
    return array ($a, $b);
};

$GLOBALS['compare_func'] = function ($a, $b) {
    if ($a === $b) {
        return 0;
    }
    return ($a > $b)? 1 : -1;
};

$GLOBALS['cube'] = function ($n) {
    return($n * $n * $n);
};

$GLOBALS['double'] = function ($value) {
    return $value * 2;
};

$GLOBALS['even'] = function ($var) {
    return(!($var & 1));
};

$GLOBALS['foo'] = function ($value)
{
    // Expected format: Surname, GivenNames
    if (strpos($value, ", ") === false)
        return false;

    list($surname, $givennames) = explode(", ", $value, 2);
    $empty = (empty($surname) || empty($givennames));
    $notstrings = (!is_string($surname) || !is_string($givennames));

    if ($empty || $notstrings) {
        return false;
    } else {
        return $value;
    }
};

$GLOBALS['foobar'] = function ($arg, $arg2) {
    return "foobar got $arg and $arg2";
};

$GLOBALS['map_Spanish'] = function ($n, $m) {
    return(array($n => $m));
};

$GLOBALS['next_year'] = function ($matches) {
    return $matches[1] . ($matches[2] + 1);
};

$GLOBALS['odd'] = function ($var) {
    return($var & 1);
};

$GLOBALS['rmul'] = function ($v, $w) {
    $v *= $w;
    return $v;
};

$GLOBALS['rsum'] = function ($v, $w) {
    $v += $w;
    return $v;
};

$GLOBALS['say_goodbye'] = function ($name) {
    return "Goodbye $name!";
};

$GLOBALS['say_hello'] = function () {
    return "Hello!";
};

$GLOBALS['show_Spanish'] = function ($n, $m) {
    return("The number $n is called $m in Spanish");
};

$GLOBALS['test_alter'] = function (&$item1, $key, $prefix) {
    $item1 = "$prefix: $item1";
};

$GLOBALS['test_print'] = function (&$item, $key) {
    $item = "$key holds $item\n";
};

$GLOBALS['to_lower'] = function ($matches) {
    return strtolower($matches[0]);
};

/**
 * List of all methods used for callbacks
 */
class pbx_callbacks
{
    /**
     * Calls the corresponding static method when the callback is called from an instance of this class
     * this is the prefered way vs calling the function directly in order to report a call to an invalid callback as an "invalid" method
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    function __call($name, $arguments)
    {
        return call_user_func_array(self::$name, $arguments);
    }

    /**
     * List of all static methods used for callbacks
     */
    static function barber($type) {
        return "You wanted a $type haircut, no problem";
    }

    static function cb1($a) {
        return array ($a);
    }

    static function cb2($a, $b) {
        return array ($a, $b);
    }

    static function compare_func($a, $b) {
        if ($a === $b) {
            return 0;
        }
        return ($a > $b)? 1 : -1;
    }

    static function cube($n) {
        return($n * $n * $n);
    }

    static function double($value) {
        return $value * 2;
    }

    static function even($var) {
        return(!($var & 1));
    }

    static function foo($value)
    {
        // Expected format: Surname, GivenNames
        if (strpos($value, ", ") === false)
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

    static function foobar($arg, $arg2) {
        return "foobar got $arg and $arg2";
    }

    static function map_Spanish($n, $m) {
        return(array($n => $m));
    }

    static function next_year($matches) {
        return $matches[1] . ($matches[2] + 1);
    }

    static function odd($var) {
        return($var & 1);
    }

    static function rmul($v, $w) {
        $v *= $w;
        return $v;
    }

    static function rsum($v, $w) {
        $v += $w;
        return $v;
    }

    static function say_goodbye($name) {
        return "Goodbye $name!";
    }

    static function say_hello() {
        return "Hello!";
    }

    static function show_Spanish($n, $m) {
        return("The number $n is called $m in Spanish");
    }

    static function test_alter(&$item1, $key, $prefix) {
        $item1 = "$prefix: $item1";
     }

    static function test_print(&$item, $key) {
        $item = "$key holds $item\n";
     }

    static function to_lower($matches) {
        return strtolower($matches[0]);
    }
}
