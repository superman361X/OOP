<?php

namespace Models\RabbitMQ;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class PubSub extends RabbitMQ
{
    public function publish()
    {
        $this->channel->exchange_declare('my.logs', 'fanout', false, false, false);
        $msg = new AMQPMessage();
        $i = 0;
        while (true) {
            $i++;
            $data = " $i Sent 'Hello World!'";
            $msg->body = $data;
            $msg->set('delivery_mode', AMQPMessage::DELIVERY_MODE_PERSISTENT);

            $this->channel->basic_publish($msg, 'my.logs');

            echo " $i : [x] Sent 'Hello World!'".PHP_EOL;
            if ($i >= 1000) break;
        }
    }


    public function subscribe()
    {
        $this->channel->exchange_declare('my.logs', 'fanout', false, false, false);

        list($queue_name, ,) = $this->channel->queue_declare("", false, false, false, false);

        $this->channel->queue_bind($queue_name, 'my.logs');

        echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo ' [x] ', $msg->body, "\n";
        };

        $this->channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }
}