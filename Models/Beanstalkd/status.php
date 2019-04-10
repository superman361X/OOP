<?php

require "vendor/autoload.php";

use Pheanstalk\Pheanstalk;

//连接beanstalkd
$pheanstalk = new Pheanstalk('127.0.0.1', 11300);

$tube_name = 'SecKill2';

//维护类
//print_r($pheanstalk->stats());exit;

$pheanstalk->listTubes(); //目前存在的管道
//print_r($pheanstalk->listTubes());exit;

$pheanstalk->statsTube($tube_name);//查看管道
//print_r($pheanstalk->statsTube($tube_name));exit;

$id = $pheanstalk->useTube($tube_name)->put(time());//指定使用的管道放入test任务
//print_r($id);exit;

//以下查看任务信息
//$job = $pheanstalk->watch($tube_name)->ignore('default')->reserve();//获取任务
//$stats = $pheanstalk->statsJob($job);

//任务的信息，可以看到任务的id
//print_r($stats); exit;

//根据任务的id可以查看任务的信息.这个id可以通过put方法的返回值获取
$job = $pheanstalk->peek($id);
$stats = $pheanstalk->statsJob($job);
//获取任务信息
print_r($job->getData());exit;

//生成类putInTube 和put
//putInTube('管道名称','任务','优先级','延迟时间')
//put('任务','优先级','延迟时间','ttr 任务超时重发时间')
$jobid = $pheanstalk->putInTube('test', 6666, 0);
// $pheanstalk->useTube('test')->put(6666);
print_r($pheanstalk->statsTube('test'));

//消费者
//reserve()方法是阻塞并获取ready状态的任务
//reserve(阻塞时间)时间到啦，不管是否获取到任务都返回
//reserveFromTube是watch 和reserve的组合
//release($job,优先级,延迟)执行的任务失败则重新放入ready状态

//bury($job)预留任务　意思是获取任务，当条件成熟再执行，
//peekBuried(管道名字)读取管道预留任务
//kickJob($job) 把预留任务放回ready状态
//kick($um)批量把任务ｉｄ小于$num的预留任务放回ready状态
//$job = $pheanstalk->useTube('test')->kick(999);

//peekReady()获取ready的任务
//$job = $pheanstalk->peekReady('test')
//peekDelayed()获取延迟的任务
//$job = $pheanstalk->peekDelayed('test')

//pauseTube()对整个管道进行延迟
$pheanstalk->pauseTube('test', 100);
//resumeTube()恢复管道不延迟
$pheanstalk->pauseTube('test');

$job = $pheanstalk->watch('test')->reserve();
$pheanstalk->touch($job);//续命，重置一次 ttr
print_r($job);
//删除任务
$pheanstalk->delete($job);
//查看监听的管道
$tubes = $pheastalk->listTubesWatched();
