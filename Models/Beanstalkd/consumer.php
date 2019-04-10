<?php

require "vendor/autoload.php";

use Pheanstalk\Pheanstalk;

//连接BeanStalkd队列系统
$ph = new Pheanstalk('127.0.0.1', 11300);
$tube_name = 'SecKill2';
//取出SecKill2管道的任务总数
$total_jobs = $ph->statsTube($tube_name)['total-jobs'];

//PDO连接mysql数据库
$dsn = "mysql:dbname=beanstalk;host=127.0.0.1";
$pdo = new PDO($dsn, 'root', 'root');

//循环取出管道中任务,并执行插入数据库操作
for ($i = 0; $i < $total_jobs; $i++) {

    //监听SecKill4管道,并将任务取出来
    $job = $ph->watch($tube_name)->reserve();

    //取出任务存储的值uid
    $uid = $job->getData();//打印出的样子 string(8) "24541944"

    if (!$uid) {
        //sleep(2);
        continue;
    }
    //生成订单号
    $orderNum = build_order_no($uid);
    //生成订单时间
    $timeStamp = time();
    //构造插入数组
    $user_data = array('uid' => $uid, 'time_stamp' => $timeStamp, 'order_num' => $orderNum);
    //将数据保存到数据库
    $sql = "insert into seckill (uid,time_stamp,order_num) values (:uid,:time_stamp,:order_num)";
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute($user_data);
    //如果数据库操作成功,则删除任务
    if ($res) {
        $ph->delete($job);
    }

}

//生成唯一订单号
function build_order_no($uid)
{
    return substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8) . $uid;
}


