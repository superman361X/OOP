<?php

namespace Models\Lock;

use \Redis;

class RedisLock
{
    private $_config;
    private $_redis;


    /**
     * 初始化
     * RedisLock constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_config = $config;
        //redis连接设定
        $this->_redis = $this->connect();
    }

    /**
     * 获取锁
     * @param  String $key 锁标识
     * @param  Int $expire 锁过期时间
     * @return Boolean
     */
    public function lock($key, $expire = 5)
    {
        $is_lock = $this->_redis->setnx($key, time() + $expire);

        // 不能获取锁
        if (!$is_lock) {

            // 判断锁是否过期
            $lock_time = $this->_redis->get($key);

            // 锁已过期，删除锁，重新获取
            if (time() > $lock_time) {
                $this->unlock($key);
                $is_lock = $this->_redis->setnx($key, time() + $expire);
            }
        }

        return $is_lock ? true : false;
    }

    /**
     * 释放锁
     * @param  String $key 锁标识
     * @return Boolean
     */
    public function unlock($key)
    {
        return $this->_redis->del($key);
    }



    /**
     * @return bool|Redis
     * @throws \Exception
     */
    private function connect()
    {
        try {
            $redis = new Redis();
            $redis->connect(
                $this->_config['host'],
                $this->_config['port'],
                $this->_config['timeout'],
                $this->_config['reserved'],
                $this->_config['retry_interval']
            );


            //授权
            if (!empty($this->_config['auth'])) {
                $redis->auth($this->_config['auth']);
            }

            $redis->select($this->_config['index']);

        } catch (\RedisException $e) {
            throw new \Exception($e->getMessage());
        }

        return $redis;
    }
}