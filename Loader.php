<?php

class Loader
{
    public static function loaders($class)
    {
        try {
            $file = $class . '.php';
            if (is_file($file)) {
                require_once($file);
            }
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}

spl_autoload_register('Loader::loaders');