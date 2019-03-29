<?php

namespace Models\Builder;

class Person
{
    private $head;
    private $body;
    private $foot;

    //头
    public function getHead()
    {
        return $this->head;
    }

    public function setHead($head)
    {
        $this->head = $head;
    }

    //体
    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    //脚
    public function getFoot()
    {
        return $this->foot;
    }

    public function setFoot($foot)
    {
        $this->foot = $foot;
    }

    public function getResult()
    {
        return $this;
    }
}