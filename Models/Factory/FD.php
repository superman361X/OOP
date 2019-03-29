<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/29
 * Time: 14:44
 */

namespace Models\Factory;


class FD implements IFactory
{
    public function getName()
    {
        echo __METHOD__ . PHP_EOL;
    }
}