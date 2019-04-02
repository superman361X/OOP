<?php

namespace Controller;

use Models\RabbitMQ\Publish;
use \Models\RabbitMQ\Send;
use \Models\RabbitMQ\Receive;
use Models\RabbitMQ\Subscribe;

class Rabbit
{

    public function send()
    {
        $mq = new Send();
        $mq->run();
    }

    public function receive()
    {
        $mq = new Receive();
        $mq->run();
    }


    public function pub()
    {
        $mq = new Publish();
        $mq->run();
    }


    public function sub()
    {
        $mq = new Subscribe();
        $mq->run();
    }

}