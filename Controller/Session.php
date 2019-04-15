<?php

namespace Controller;


class Session extends Base
{

    public function cookie()
    {
        setcookie('name','zhouc');
        //http response set-cookie
    }


    public function session()
    {
        //request cookie
        session_start();
    }


    public function token()
    {
        session_start();
        dump($_COOKIE);
    }
}