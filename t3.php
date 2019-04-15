<?php

class BaseApp
{
    /**
     * 调用子类方法
     * @author ikmb email:ikmb@163.com
     * @version  创建时间：2011-7-8 下午11:19:17
     */
    function _run_action()
    {
        $action = "index";
        $this->$action();
    }
}

class DefaultApp extends BaseApp
{

    /**
     * 此方法将在父类中调用
     */
    function index()
    {
        echo "DefaultApp->index() invoked";
    }

    function Go()
    {
        //调用父类
        parent::_run_action();
    }
}

$default = new DefaultApp();

$default->Go();