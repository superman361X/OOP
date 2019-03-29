<?php

namespace Models\Factory;
/**
 * 创建一个基本的工厂类
 * Class SimpleFactory
 * 工厂模式就是一种类，具有为您创建对象的某些方法，这样就可以使用工厂类创建对象，而不直接使用new。这样如果想更改创建的对象类型，只需更改该工厂即可。
 */
class Simple
{
    const TYPE_A = 1;
    const TYPE_B = 2;
    const TYPE_C = 3;
    const TYPE_D = 4;

    //创建一个返回对象实例的静态方法
    public static function Factory($type)
    {
        switch ($type) {
            case self::TYPE_A:
                return new FA();
                break;
            case self::TYPE_B:
                return new FB();
                break;
            case self::TYPE_C:
                return new FC();
                break;
            case self::TYPE_D:
                return new FD();
                break;
            default:
                throw new \Exception('Type error');
        }
    }
}