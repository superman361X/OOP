<?php

namespace Controller;

use \Models\Observer\Event;
use \Models\Observer\ObServer1;
use \Models\Observer\ObServer2;
use \Models\Singleton\Singleton;
use \Models\Factory\Simple;
use \Models\Factory\IFactory;
use \Models\Registry\Registry;
use \Models\Object\Builder;


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

}
