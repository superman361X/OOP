<?php

namespace Controller;

use \Models\RabbitMQ\Send;
use \Models\RabbitMQ\Receive;

class Rabbit
{

    public function send()
    {
        $mq = new Send();
        $mq->run();
    }

    public function run1()
    {
        $mq = new Receive();
        $mq->run1();
    }


    public function run2()
    {
        $mq = new Receive();
        $mq->run2();
    }

    public function run3()
    {
        $mq = new Receive();
        $mq->run3();
    }

    public function run4()
    {
        $mq = new Receive();
        $mq->run4();
    }


}