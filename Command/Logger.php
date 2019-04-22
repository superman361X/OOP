<?php

namespace Command;

class Logger
{
    public function logger()
    {
        (new  \Models\Logger())->logger();
    }
}



//docker run -ti -d --name my-nginx -p 8088:80 -v /www:/var/www/html/ docker.io/nginx
//docker exec -it 775c7c9ee1e1 /bin/bash