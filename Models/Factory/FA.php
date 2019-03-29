<?php

namespace Models\Factory;


class FA implements IFactory
{
    public function getName()
    {
        echo __METHOD__ . PHP_EOL;
    }
}