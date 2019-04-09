<?php

namespace Common;

class MyException extends \Exception
{
    public static function handler($exception)
    {
        echo $exception->getMessage();
    }
}


set_exception_handler('\Common\MyException::handler');