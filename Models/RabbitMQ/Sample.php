<?php

namespace Models\RabbitMQ;


use PhpAmqpLib\Message\AMQPMessage;

class Sample extends RabbitMQ
{
    public function send()
    {
        $this->channel->queue_declare('xxx', false, true, false, false);

        $msg = new AMQPMessage('Hello World!');
        $this->channel->basic_publish($msg, '', 'hello');

        echo " [x] Sent 'Hello World!'\n";
    }

    public function receive()
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