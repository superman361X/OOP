<?php

namespace Models;

use Models\RabbitMQ\RabbitMQ;
use PhpAmqpLib\Message\AMQPMessage;

class Logger extends RabbitMQ
{

    public function logQueue($data = '')
    {
        $this->channel->queue_declare('demo002', false, true, false, false);

        $data = $data ? $data : " ::::Hello World!";
        $msg = new AMQPMessage($data,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $this->channel->basic_publish($msg, '', 'demo002');
    }

    public function logger()
    {
        $this->channel->queue_declare('demo002', false, true, false, false);

        $callback = function ($msg) {
            //todo logger
            $fp = fopen('runtime/app.log', 'a+');
            if (flock($fp, LOCK_EX | LOCK_NB)) {
//                usleep(10);
                fwrite($fp, date('Y-m-d H:i:s') . ' => '.var_export(json_decode($msg->body),true) . PHP_EOL);
                flock($fp, LOCK_UN);
            } else {
                echo 'get lock fail...' . PHP_EOL;
            }
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume('demo002', '', false, false, false, false, $callback);

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

}