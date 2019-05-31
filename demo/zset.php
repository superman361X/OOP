<?php

$redis = new Redis();
$redis->connect(
    '192.168.1.113',
    6379
);

$redis->auth('int@1515');

//设置ben的score
$redis->zadd('rank', 260,
    json_encode(
        array(
            'username' => 'ben',
            'userId' => 23
        )
    )
);

//设置dongxie的score
$redis->zadd('rank', 250,
    json_encode(
        array(
            'username' => 'dongxie',
            'userId' => 33
        )
    )
);

//设置xidu的score
$redis->zadd('rank', 50,
    json_encode(
        array(
            'username' => 'xidu',
            'userId' => 45
        )
    )
);

//更新xidu的score
$redis->zadd('rank', 6000,
    json_encode(
        array(
            'username' => 'xidu',
            'userId' => 45
        )
    )
);

echo '<pre>';
print_r($redis->zRevRange('rank', 0, 1));