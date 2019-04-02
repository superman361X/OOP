<?php

namespace Controller;

use \Models\Lock\FileLock;
use \Models\Lock\RedisLock;

class Lock
{
    //File锁
    public function file()
    {

        try {
            //todo 对业务请求加锁
            $lock = new FileLock('lock');
            $lockResult = $lock->lock();

            if (!$lockResult) {
                $lock->unlock();
                throw new \Exception('request too frequently');
            }

            //todo 正常的业务逻辑处理

            //todo something...
            sleep(3);
            //todo 业务逻辑处理完毕解锁
            $lock->unlock();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }


    //Redis锁
    public function redis()
    {
        try {

            $config = array(
                'host' => '127.0.0.1',
                'port' => 6379,
                'index' => 0,
                'auth' => 'int@1515',
                'timeout' => 1,
                'reserved' => NULL,
                'retry_interval' => 100,
            );

            // todo 创建redis lock对象
            $oRedisLock = new RedisLock($config);

            // 定义锁标识
            $key = 'myLock';

            // todo 获取锁
            $is_lock = $oRedisLock->lock($key, 10);

            if ($is_lock) {
                //todo 正常的业务逻辑处理
                sleep(5);
                //todo 业务逻辑处理完毕解锁
                $oRedisLock->unlock($key);
            } else {
                // 获取锁失败
                throw new \Exception('request too frequently');
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}