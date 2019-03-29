<?php
namespace Models\Observer;
/**
 * 观察者1
 */
class ObServer1 implements IObServer
{
    public function update($event_info = null)
    {
        echo "观察者1 收到执行通知 执行完毕！\n";
    }
}