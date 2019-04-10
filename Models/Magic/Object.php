<?php

namespace Models\Magic;

class Object
{
    private $obj;
    private $params = [];

    public function __construct()
    {
        $this->obj = new Func();
    }

    public function __call($name, $arguments)
    {
        $this->obj->$name($arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        Func::$name($arguments);
    }

    public function __get($name)
    {
        print_r($this->params[$name]);
        echo PHP_EOL;
    }


    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function __sleep()
    {

    }

    public function __isset($name)
    {

    }


    public function __unset($name)
    {
    }

    public function __toString()
    {
        return 'xxxx';
    }


    public function __wakeup()
    {

    }
}