<?php

class A
{
    /**
     * 调用子类方法
     * @author ikmb email:ikmb@163.com
     * @version  创建时间：2011-7-8 下午11:19:17
     */
    protected function go()
    {
        $this->index();
    }

    private function index(){
        echo __METHOD__;
        echo PHP_EOL;
    }
}

class B extends A
{

    /**
     * 此方法将在父类中调用
     */
    public function index()
    {
        echo __METHOD__;
        echo PHP_EOL;
    }

    public function go()
    {
        //调用父类
        parent::go();
    }
}

$default = new B();

$default->go();


class C
{
    private function get()
    {
        echo __METHOD__;
        echo PHP_EOL;
    }

    public function go()
    {
        $this->get();
    }
}

class D extends C
{
    public function get()
    {
        echo __METHOD__;
        echo PHP_EOL;
    }
}


$obj = new C();
$obj->go();
