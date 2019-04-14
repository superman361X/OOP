<?php

namespace Models\Registry;

abstract class Registry
{
    const LOGGER = 'logger';
    const EMAIL = 'email';
    const MESSAGE = 'message';

    protected static $objects = [];

    public static function set($alias, $value)
    {
        self::$objects[$alias] = $value;
    }

    public static function get($alias = null)
    {
        if ($alias)
            return self::$objects[$alias];
        else
            return self::$objects;
    }

    public static function unset($alias)
    {
        unset(self::$objects[$alias]);
    }

}
