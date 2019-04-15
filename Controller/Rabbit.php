<?php

namespace Controller;

use Models\RabbitMQ\Sample;
use Models\RabbitMQ\Worker;

class Rabbit extends Base
{

    public function sampleSend()
    {
        $rabbit = new Sample();
        $rabbit->send();
    }


    public function sampleReceive()
    {
        $rabbit = new Sample();
        $rabbit->receive();
    }

    public function sampleReceive2()
    {
        $rabbit = new Sample();
        $rabbit->receive2();
    }


    public function newTask()
    {
        (new Worker())->newTask();
    }

    public function newWorker()
    {
        (new Worker())->newWorker();
    }

    public function newWorker2()
    {
        (new Worker())->newWorker2();
    }
}