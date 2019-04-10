<?php
namespace Models\Object;

//客户端
class Builder
{

    public static function main()
    {
        $builder = new Person();

        $builder->setHead("头");
        $builder->setBody("躯干");
        $builder->setFoot("脚");

        return $builder->getResult();
    }
}
