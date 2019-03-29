<?php

namespace Models\Singleton;

class Singleton
{
    private static $instance = null;
    private $params;

    private function __construct($params)
    {
        $this->params = $params;
    }

    private function __clone()
    {

    }

    public static function getInstance($params)
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($params);
        }

        return self::$instance;
    }

    public function getName()
    {
        return 'SingletonMode::' . $this->params . PHP_EOL;
    }
}