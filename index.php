<?php

//define('ROOT', dirname(__FILE__));

require_once "Common/functions.php";
require_once "Loader.php";
require_once __DIR__ . '/vendor/autoload.php';


list($a, $b, $c, $d) = explode("/", $_SERVER['REQUEST_URI']);
$ctxName = "\\Controller\\" . ucfirst(strtolower($b));
$funName = strtolower($c);
try {
    if (class_exists($ctxName) && method_exists($ctxName, $funName)) {
        (new $ctxName())->$funName();
    } else {
        throw new Exception('Not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


//http://zc.kkk.cc/rabbit/send