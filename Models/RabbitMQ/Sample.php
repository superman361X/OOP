<?php

namespace Models\RabbitMQ;


use PhpAmqpLib\Message\AMQPMessage;

class Sample extends RabbitMQ
{
    public function send()
    {
        $this->channel->queue_declare('demo003', false, true, false, false);

        $i = 1;
        while ($i <= 50) {
            $msg = new AMQPMessage($i . ' ==> Hello World!', array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
            $this->channel->basic_publish($msg, '', 'key');

            echo " [{$i}][x] Sent 'Hello World!'\n";
            usleep(1000);
            $i++;
        }

    }

    public function receive()
    {
        $this->channel->queue_declare('demo003', false, true, false, false);
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo " [x] Received ", $msg->body, "\n";
            usleep(1000);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume('demo003', '', false, false, false, false, $callback);

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    public function receive2()
    {
        $this->channel->queue_declare('xxx', false, true, false, false);
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo " [x] Received ", $msg->body, "\n";
        };

        $this->channel->basic_consume('hello', '', false, true, false, false, $callback);

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }




}