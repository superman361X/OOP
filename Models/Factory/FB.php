<?php

namespace Models\Factory;


class FB implements IFactory
{
    public function getName()
    {
        echo __METHOD__.PHP_EOL;
    }
}