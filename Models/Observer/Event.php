<?php

namespace Models\Observer;


/**
 * 事件
 * Class Event
 */
class Event extends Observer
{
    /**
     * 触发事件
     */
    public function trigger()
    {
        //通知观察者
        $this->notify();
    }
}