<?php

namespace Models\Factory;


class FC implements IFactory
{
    public function getName()
    {
        echo __METHOD__ . PHP_EOL;
    }
}