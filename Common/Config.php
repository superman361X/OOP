<?php

namespace Common;


class Config implements \ArrayAccess
{
    protected $path;
    protected $configs = array();

    public function __construct($path)
    {
        $this->path = $path;

    }

    //获取配置值
    public function offsetGet($key)
    {
        if (empty($this->configs[$key])) {
            $file_path = $this->path . '/' . $key . '.php';
            $config = require $file_path;
            $this->configs[$key] = $config;
        }
        return $this->configs[$key];
    }

    //设置配置值
    public function offsetSet($key, $value)
    {
        throw new \Exception("cannot write config file.");
    }

    //检查配置是否存在
    public function offsetExists($key)
    {
        return isset($this->configs[$key]);
    }

    //删除配置
    public function offsetUnset($key)
    {
        unset($this->configs[$key]);
    }

}