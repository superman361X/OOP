<?php

namespace Common;

class Pager

{

    protected $data = [
        ['id' => 1, 'pid' => 0, 'name' => '数码'],
        ['id' => 2, 'pid' => 0, 'name' => '电器'],
        ['id' => 3, 'pid' => 0, 'name' => '服装'],
        ['id' => 4, 'pid' => 1, 'name' => '手机'],
        ['id' => 5, 'pid' => 1, 'name' => '电脑'],
        ['id' => 6, 'pid' => 2, 'name' => '电视'],
        ['id' => 7, 'pid' => 2, 'name' => '冰箱'],
        ['id' => 8, 'pid' => 3, 'name' => '男装'],
        ['id' => 9, 'pid' => 3, 'name' => '女装'],
        ['id' => 10, 'pid' => 9, 'name' => '长裙'],
        ['id' => 11, 'pid' => 9, 'name' => '短裙'],
    ];

    protected $page = 1;
    protected $size = 10;


    public function __construct($page = 1, $size = 10)
    {
        $this->page = $page;
        $this->size = $size;
    }

    public function page()
    {
        $result = [
            'page' => [
                'current' => $this->page,
                'total' => ceil(count($this->data)),
                'list' => range(1, ceil(count($this->data) / $this->size)),
            ],
            'data' => array_splice($this->data, ($this->page - 1) * $this->size, $this->size), //2.offset //3.length
        ];
        print_r($result);
    }

}

