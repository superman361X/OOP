<?php

namespace Models\RabbitMQ;

use Common\Config;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQ
{
    protected $config;
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $config = new Config('Config');
        $this->config = $config['rabbitmq'];

        $this->connection = new AMQPStreamConnection($this->config['host'], $this->config['port'], $this->config['username'], $this->config['password']);
        $this->channel = $this->connection->channel();
    }


    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}