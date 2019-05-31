<?php

namespace Controller;

class Demo extends Base
{
    public function __construct()
    {
    }


    public function index()
    {
        $a = new \Models\Snow();
        $b = clone $a;

        var_dump($a);
        var_dump($b);
    }

    public function __destruct()
    {
        echo "__destruct" . PHP_EOL;
    }

}