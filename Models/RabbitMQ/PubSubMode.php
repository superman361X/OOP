<?php

namespace Models\RabbitMQ;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class PubSubMode
{
    public function publish()
    {
        $connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $channel = $connection->channel();

        $channel->exchange_declare('logs', 'fanout', false, false, false);

        $msg = new AMQPMessage();

        $i = 0;
        while (true) {
            $i++;
            $data = " $i Sent 'Hello World!'";
            $msg->body = $data;
            $msg->set('delivery_mode', AMQPMessage::DELIVERY_MODE_PERSISTENT);

            $channel->basic_publish($msg, 'logs');

            echo " $i : [x] Sent 'Hello World!'<br/>";
            if ($i >= 10) break;
        }

        $channel->close();
        $connection->close();
    }



    public function subscribe()
    {

        $connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $channel = $connection->channel();

        $channel->exchange_declare('logs', 'fanout', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

        $channel->queue_bind($queue_name, 'logs');

        echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo ' [x] ', $msg->body, "\n";
        };

        $channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}