<?php

$f = 0.59;
//var_dump(intval($f * 100)); //为啥输出57


function getMount($n)
{
    $conf = [
        1 => [1, 5, 30],
        2 => [5, 10, 25],
        3 => [10, 30, 20],
        4 => [30, 50, 15],
        5 => [50, 80, 10],
        6 => [80, 100, 5],
        7 => [100, 0, 1],
    ];

    static $c = 0;
    for ($i = 1; $i < count($conf); $i++) {

        switch ($n) {
            case $n >= $conf[$i][0] && $n < $conf[$i][1]:
                $c += $conf[1][2];
        }

    }
    echo $c.PHP_EOL;



//
//    $mount = 0;
//    foreach ($conf as $k => $v) {
//        if ($n >= $v[0] && $n < $v[1]) {
//            $mount += $v[2] * $n;
//            echo $v[2].'*'.$n.PHP_EOL;
//        }
//    }
//
//    return $mount;
}

echo getMount(9);
echo PHP_EOL;
