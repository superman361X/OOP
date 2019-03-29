<?php
namespace Models\Observer;
/**
 * 观察者2
 */
class ObServer2 implements IObServer
{
    public function update($event_info = null)
    {
        echo "观察者2 收到执行通知 执行完毕！\n";
    }
}