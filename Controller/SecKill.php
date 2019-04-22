<?php

namespace Controller;

use function Common\dump;
use \Predis\Client;

class SecKill
{

    private $redis;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('47.106.156.73', 6379);
        $this->redis->auth('int@1515');
        $this->redis->select(1);
    }


    public function run()
    {
        $key = 'SecKill';
        $uid = microtime();
        if ($this->redis->lLen($key) > 100) {
            echo 'end';
            echo PHP_EOL;
            exit;
        }
        $this->redis->lPush($key, $uid);
    }


    public function run2()
    {
        $this->redis->setnx('SecKill2', 100);
        if ($this->redis->get('SecKill2') > 0) {
            $this->redis->decr('SecKill2');
            $this->redis->lPush('SecKill3', microtime());
        } else {
            echo 'end';
            echo PHP_EOL;
            exit;
        }

    }


    public function kk()
    {

        //初始化redis对象
        $redis = new \Redis();
        //连接sentinel服务 host为ip，port为端口，哨兵的ip和端口号
        $redis->connect('192.168.2.113', '26379');

        //获取主库列表及其状态信息
        $result = $redis->rawCommand('SENTINEL', 'masters');
        print_r($result);


        //根据所配置的主库redis名称获取对应的信息
        //master_name应该由运维告知（也可以由上一步的信息中获取）
        $result = $redis->rawCommand('SENTINEL', 'master', 'mymaster');
        print_r($result);

        //根据所配置的主库redis名称获取其对应从库列表及其信息
        $result = $redis->rawCommand('SENTINEL', 'slaves', 'mymaster');
        print_r($result);

        //获取特定名称的redis主库地址
        $result = $redis->rawCommand('SENTINEL', 'get-master-addr-by-name', 'mymaster');
        //以上部分可以获取到主库的ip和对应端口，程序可以直接像链接单台redis一样链接操作使用 

        print_r($result);

        //初始化redis对象
        $client = new \Redis();
        //连接sentinel服务 host为ip，port为端口，哨兵的ip和端口号
        $client->connect($result[0], $result[1]);
        $client->auth('int@1515');
        $client->select(0);

        $client->set('face','face');
        var_dump($client->get('face'));


    }


}