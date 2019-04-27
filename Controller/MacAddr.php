<?php

namespace Controller;

use Models\Snowflake;

class MacAddr
{
    public function mac()
    {

        $obj = new \Models\MacAddr(PHP_OS);
        print_r($obj->result);
        echo $obj->macAddr;

    }


    public function snow()
    {
        $snow = new Snowflake(1, 0);
        $uuid = $snow->generateID();//生成ID
        echo $uuid;
        echo PHP_EOL;
        //Particle::timeFromParticle($particle);//反向计算时间戳
    }
}
