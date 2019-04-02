<?php

namespace Models\RabbitMQ;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Send
{

    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $this->channel = $this->connection->channel();
    }


    public function run()
    {

        $this->channel->exchange_declare(
            'zc_exchange',
            'fanout',
            false,
            true
        );

        $this->channel->queue_declare(
            'order_queue',
            false,
            true,
            false,
            false
        );

        $msg = new AMQPMessage();
        $i = 0;
        while (true) {

            $data = [
                'id' => $i,
                'name' => 'San',
                'age' => 20,
                'sex' => 'man'
            ];
            $msg->setBody(json_encode($data, JSON_UNESCAPED_UNICODE));
            $msg->set('delivery_mode', AMQPMessage::DELIVERY_MODE_PERSISTENT);

            $this->channel->basic_publish($msg, 'zc_exchange', 'zc_key');

            $i++;
            echo " $i : [x] Sent 'Hello World!'<br/>";
            if ($i >= 10) break;

        }
    }


    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();

    }

}