<?php
namespace Models\Observer;
/**
 * 观察者接口类
 * Interface ObServer
 */
interface IObServer
{
    public function update($event_info = null);
}
