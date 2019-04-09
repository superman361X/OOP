<?php

namespace Models\Lock;

use \Redis;

class RedisLock2
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
     * @param $key
     * @param $value
     * @param int $expire
     * @return bool
     */
    public function lock($key, $value, $expire = 5)
    {
        $is_lock = $this->_redis->set(
            $key,
            $value,
            ['nx', 'ex' => $expire]
        );
        return $is_lock ? true : false;
    }

    /**
     *
     * @param  String $key 锁标识
     * @return Boolean
     */

    /**
     * 释放锁
     * @param $key
     * @param $value
     */
    public function unlock($key, $value)
    {
        $redisVal = $this->_redis->get($key);
        $this->_redis->watch($key);
        $this->_redis->multi();
        if ($redisVal == $value) {
            $this->_redis->del($key);
        }

        $this->_redis->exec();
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