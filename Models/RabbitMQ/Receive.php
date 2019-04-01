<?php

namespace Models\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Receive
{
    protected $connection;
    protected $channel;


    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $this->channel = $this->connection->channel();
    }

    public function run1()
    {
        $this->connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('hello', false, false, false, false);
        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };

        $this->channel->basic_consume('hello', '', false, true, false, false, $callback);
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }


    public function run2()
    {
        $this->connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };


        $this->channel->basic_consume('hello', '', false, true, false, false, $callback);
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }

    }


    public function run3()
    {
        $this->connection = new AMQPStreamConnection('192.168.2.113', 5672, 'zhouc', 'zhouc');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };


        $this->channel->basic_consume('hello', '', false, true, false, false, $callback);
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    public function run4()
    {
        $this->connection = new AMQPStreamConnection('192.168.2.113', 5672, 'zhouc', 'zhouc');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };


        $this->channel->basic_consume('hello', '', false, true, false, false, $callback);
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }


    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();

    }

}