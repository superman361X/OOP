<?php

namespace Models\Observer;

/**
 * 事件产生类
 * Class Observer
 */
abstract class Observer
{
    private $ObServers = [];

    public abstract function trigger();

    //增加观察者
    public function register(IObServer $ObServer)
    {
        $this->ObServers[] = $ObServer;
    }

    //事件通知
    protected function notify()
    {
        foreach ($this->ObServers as $ObServer) {
            $ObServer->update();
        }
    }

}