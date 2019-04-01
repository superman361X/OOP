<?php

namespace Controller;

use \Models\Observer\Event;
use \Models\Observer\ObServer1;
use \Models\Observer\ObServer2;
use \Models\Singleton\Singleton;
use \Models\Factory\Simple;
use \Models\Factory\IFactory;
use \Models\Registry\Registry;
use \Models\Builder\Builder;
use \Models\Lock\FileLock;
use \Models\Lock\RedisLock;


class Index
{

    //单例
    public function t1()
    {
        try {
            $first = Singleton::getInstance('LiYuan');
            echo $first->getName() . PHP_EOL;

        } catch (\throwable $e) {
            echo $e->getMessage() . PHP_EOL;
        }

    }

    //观察者
    public function t2()
    {
        //创建一个事件
        $event = new Event();
        //为事件增加旁观者
        $event->register(new ObServer1());
        $event->register(new ObServer2());
        //执行事件 通知旁观者
        $event->trigger();
    }


    //注册树1
    public function t3()
    {
        //todo 将工厂方法产生的对象注册到树上
        Registry::set(Registry::LOGGER, Simple::Factory(Simple::TYPE_A));
        Registry::set(Registry::EMAIL, Simple::Factory(Simple::TYPE_B));
        Registry::set(Registry::MESSAGE, Simple::Factory(Simple::TYPE_C));

        dump(Registry::get());
    }

    //注册树2
    public function t4()
    {
        //Registry::unset(Registry::LOGGER);
        //print_r(Registry::get());
        $obj = Registry::get(Registry::LOGGER);
        if ($obj instanceof IFactory) {
            $obj->getName();
        }
        $obj2 = Registry::get(Registry::EMAIL);
        if ($obj2 instanceof IFactory) {
            $obj2->getName();
        }
    }


    public function t5()
    {
        $result = Builder::main();
        print_r($result);
    }

    //File锁
    public function t6()
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
    public function t7()
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
