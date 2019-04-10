<?php

//define('ROOT', dirname(__FILE__));

require_once "Common/functions.php";
require_once "Loader.php";
require_once "Common/MyException.php";
require_once __DIR__ . '/vendor/autoload.php';


list($a, $b) = explode("/", $argv[1]);

$ctxName = "\\Controller\\" . ucfirst(strtolower($a));
$funName = strtolower($b);

try {
    if (class_exists($ctxName) && method_exists($ctxName, $funName)) {
        (new $ctxName())->$funName();
    } else {
        throw new Exception('Not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
//php cli.php rabbit/run1