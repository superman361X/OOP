<?php

namespace Controller;

use \Models\Magic\Object;

class Oop extends Base
{

    public function magic()
    {
        $obj = new Object();
        //$obj->jack('man');

        //Object::luce('woman');

        $obj->name = 'jone';
        $obj->name;
    }
}