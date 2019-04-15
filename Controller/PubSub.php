<?php

namespace Controller;


class PubSub
{
    public function pub()
    {
        (new \Models\RabbitMQ\PubSub())->publish();
    }

    public function sub()
    {
        (new \Models\RabbitMQ\PubSub())->subscribe();
    }

}