<?php

namespace Models\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

class FanoutExchange extends RabbitMQ
{

    public function task()
    {
        $this->channel->exchange_declare('my.fanout', 'fanout', false, true, false);
        $this->channel->queue_declare('my.fanout.queue', false, true, false, false);

        $this->channel->queue_bind('my.fanout.queue', 'my.fanout');

//        $data = [
//            'id' => $i,
//            'name' => 'San',
//            'age' => 20,
//            'sex' => 'man'
//        ];
//        $msg->setBody(json_encode($data, JSON_UNESCAPED_UNICODE));
//        $msg->set('delivery_mode', AMQPMessage::DELIVERY_MODE_PERSISTENT);

        for ($i = 1; $i <= 1000; $i++) {
            $data = $i . ':Hello world -> ' . date('Y-m-d H:i:s', time());
            $msg = new AMQPMessage($data, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
            $this->channel->basic_publish($msg, 'my.fanout');
            echo " [x] Sent ", $data, "\n\n\n";
        }

    }


    public function worker()
    {

        $this->channel->queue_declare('my.fanout.queue', false, true, false, false);
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo " [x] Received ", $msg->body, "\n";
            //sleep(1);
            echo " [x] Done", "\n\n\n";
            //$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $this->channel->queue_bind('my.fanout.queue', 'my.fanout');
        //$channel->basic_qos(null, 1, null);
        $this->channel->basic_consume('my.fanout.queue', '', false, true, false, false, $callback);

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