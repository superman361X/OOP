<?php

define('ROOT', dirname(__FILE__));

require_once "Common/functions.php";
require_once "Loader.php";
require_once __DIR__ . '/vendor/autoload.php';

$client = new \Controller\Rabbit();

$client->run4();