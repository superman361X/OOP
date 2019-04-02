<?php

namespace Models\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Receive
{
    protected $connection;
    protected $channel;


    public function run()
    {
        $this->connection = new AMQPStreamConnection(
            '192.168.2.113',
            5672,
            'www',
            'www'
        );
        $this->channel = $this->connection->channel();

        $this->channel->exchange_declare('zc_exchange', 'fanout');

        list($queue_name, ,) = $this->channel->queue_declare(
            'order_queue',
            false,
            true,
            false,
            false
        );

        $this->channel->queue_bind($queue_name, 'zc_exchange', 'zc_key');

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume(
            'order_queue',
            '',
            false,
            true,
            false,
            false,
            function ($msg) {
                echo " [x] Received ", $msg->body, "\n";
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            }
        );

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }


        $this->channel->close();
        $this->connection->close();
    }


}