<?php
namespace Common;

class MyException extends \Exception
{
    public static function handler($exception)
    {
        throw new \Exception($exception->getMessage());
    }
}


//set_exception_handler('\Common\MyException::handler');