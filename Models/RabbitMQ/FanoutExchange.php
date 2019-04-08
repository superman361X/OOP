<?php

namespace Models\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class FanoutExchange
{
    public function task()
    {
        $connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $channel = $connection->channel();

        $channel->exchange_declare('my.fanout', 'fanout', false, true, false);
        $channel->queue_declare('my.fanout.queue', false, true, false, false);

        $channel->queue_bind('my.fanout.queue', 'my.fanout');

        for ($i = 1; $i <= 1000; $i++) {
            $data = $i . ':Hello world -> ' . date('Y-m-d H:i:s', time());
            $msg = new AMQPMessage($data, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
            $channel->basic_publish($msg, 'my.fanout');
            echo " [x] Sent ", $data, "\n\n\n";
        }

        $channel->close();
        $connection->close();
    }


    public function worker()
    {
        $connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $channel = $connection->channel();

        $channel->queue_declare('my.fanout.queue', false, true, false, false);
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo " [x] Received ", $msg->body, "\n";
            //sleep(1);
            echo " [x] Done", "\n\n\n";
            //$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $channel->queue_bind('my.fanout.queue', 'my.fanout');
        //$channel->basic_qos(null, 1, null);
        $channel->basic_consume('my.fanout.queue', '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}