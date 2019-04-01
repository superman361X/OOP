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
        $this->channel->queue_declare('hello', false, false, false, false);


        $msg = new AMQPMessage();
        $i = 0;
        while (1) {

            $data = [
                'id' => $i,
                'name' => '杜三炮',
                'age' => 20,
                'sex' => '男'
            ];
            $msg->setBody(json_encode($data, JSON_UNESCAPED_UNICODE));
            $this->channel->basic_publish($msg, '', 'hello');

            $i++;
            echo " $i : [x] Sent 'Hello World!'<br/>";
            if ($i > 15) break;

        }
    }


    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();

    }

}