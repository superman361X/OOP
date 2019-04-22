<?php

namespace Controller;

use Models\RabbitMQ\Sample;
use Models\RabbitMQ\Worker;

class Rabbit extends Base
{

    public function sampleSend()
    {
        (new Sample())->send();
    }


    public function sampleReceive()
    {
        (new Sample())->receive();
    }

    public function sampleReceive2()
    {
        (new Sample())->receive2();
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