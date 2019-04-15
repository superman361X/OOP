<?php

namespace Controller;


use Models\Logger;

class Base
{
    public function __destruct()
    {
        $log = array_shift(debug_backtrace());
        $log['time'] = time();
        (new  Logger())->logQueue(json_encode($log, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

}