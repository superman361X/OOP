<?php

namespace Command;

class Logger
{
    public function logger()
    {
        (new  \Models\Logger())->logger();
    }
}