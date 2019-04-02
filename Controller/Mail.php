<?php

namespace Controller;


use Models\Mailer\Mailer;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Mail
{
    public function send()
    {

        $connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $channel = $connection->channel();
        $channel->queue_declare('task_queue', false, true, false, false);

        $data = [
            'title' => 'hi',
            'content' => 'good job',
            'address' => 'chao.zhou@seeed.cc',
        ];
        $msg = new AMQPMessage(
            serialize($data),
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );
        $channel->basic_publish($msg, '', 'task_queue');
        echo ' [x] Add to queue ', "\n";
        $channel->close();
        $connection->close();
    }


    public function run()
    {

        $mailer = new Mailer();

        $connection = new AMQPStreamConnection('192.168.2.113', 5672, 'www', 'www');
        $channel = $connection->channel();


        $channel->queue_declare('task_queue', false, true, false, false);
        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) use ($mailer){
            echo ' [x] Received ', $msg->body, "\n";

            $params = unserialize($msg->body);
            foreach ($params as $name => $value){
                $mailer->$name = $value;
            }

            $mailer->send();
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };
        $channel->basic_qos(null, 1, null);
        $channel->basic_consume('task_queue', '', false, false, false, false, $callback);
        while (count($channel->callbacks)) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }
}