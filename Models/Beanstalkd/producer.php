<?php

require "vendor/autoload.php";

use Pheanstalk\Pheanstalk;

//连接beanstalkd
$ph = new Pheanstalk('127.0.0.1', 11300);

$tube_name = 'SecKill2';

//使用SecKill2管道
$SEC = $ph->useTube($tube_name);

//模拟100人请求秒杀
for ($i = 0; $i < 10; $i++) {
    $uid = rand(10000000, 99999999);
    //获取当前队列已经拥有的数量,如果人数少于十,则加入这个队列
    $total_jobs = $ph->statsTube($tube_name)['total-jobs'];
    $num = 100;
    //usleep(1500);
    if ($total_jobs < $num) {
        $SEC->put($uid);//向管道放任务
        echo "Success:". md5(base64_encode($uid))   . PHP_EOL;
    } else {
        //如果当前队列人数已经达到10人,则返回秒杀已完成
        echo "Fail end" . PHP_EOL;
        //break;
    }
}
//print_r($ph->statsTube($tube_name));//查看SecKill2管道的信息

