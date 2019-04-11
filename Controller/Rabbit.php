<?php

namespace Controller;

use Models\RabbitMQ\DirectExchange;
use Models\RabbitMQ\FanoutExchange;
use Models\RabbitMQ\Sample;
use \Models\RabbitMQ\Send;
use \Models\RabbitMQ\Receive;

class Rabbit
{

    public function fanoutTask()
    {
        $rabbit = new FanoutExchange();
        $rabbit->task();
    }

    public function fanoutWorker()
    {
        $rabbit = new FanoutExchange();
        $rabbit->worker();
    }


    public function directTask()
    {
        $rabbit = new DirectExchange();
        $rabbit->task();
    }

    public function directWorker()
    {
        $rabbit = new DirectExchange();
        $rabbit->worker();
    }

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

}