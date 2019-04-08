<?php

namespace Models\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

class DirectExchange extends RabbitMQ
{
    public function task()
    {
        $this->channel->exchange_declare('my.direct', 'direct', false, true, false);
        //$this->channel->queue_declare('my.direct.queue', false, true, false, false);
        //$this->channel->queue_bind('my.direct.queue', 'my.direct', '123456');

        for ($i = 1; $i <= 1000; $i++) {
            $data = $i . ':Hello world -> ' . date('Y-m-d H:i:s', time());
            $msg = new AMQPMessage($data, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
            $this->channel->basic_publish($msg, 'my.direct', '123456');
            echo " [x] Sent ", $data, "\n\n\n";
        }
    }


    public function worker()
    {
        $this->channel->exchange_declare('my.direct', 'direct', false, true, false);

        list($queue_name, ,) = $this->channel->queue_declare('my.direct.queue', false, true, false, false);
        $this->channel->queue_bind($queue_name, 'my.direct', '123456');

        echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo " [x] Received {$msg->delivery_info['routing_key']} => ", $msg->body, "\n";
            echo " [x] Done", "\n\n\n";
            //$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }
}