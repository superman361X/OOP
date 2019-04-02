<?php

namespace Models\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Publish
{

    public function run()
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

}