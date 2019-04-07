<?php
function t1()
{
    for ($i = 1; $i <= 9; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo "$j*$i =" . $i * $j . " ";
        }
        echo PHP_EOL;
    }
}

t1();


function t2()
{
    $arr = [1, 3, 4, 2, 9, 6, 8, 7];
    $count = count($arr);
    for ($i = 0; $i < $count; $i++) {
        for ($j = $i + 1; $j < $count; $j++) {
            if ($arr[$i] > $arr[$j]) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }

        }
    }

    print_r($arr);
}

t2();

function t3($dir)
{
    $handle = @opendir($dir);
    $files = [];
    if ($handle) {
        while (($file = @readdir($handle)) !== false) {
            if (is_dir($file) && $file != '.' && $file != '..') {
                $path = $dir . '/' . $file;
                $files[$file] = t3($path);
            } else {
                $files[] = $file;
            }

        }

    }
    return $files;
}

print_r(t3('.'));


function t4()
{
    $a = 0;
    $b = 0;
    if ($a = 3 || $b = 3) {
        $a++;
        $b++;
    }
    echo $a, $b;

}

t4();
echo PHP_EOL;

function t5()
{
    $a = 1;
    $b = 2;
    list($a, $b) = array($b, $a);
    var_dump($a);
    var_dump($b);
}

t5();


function t6()
{
    $arr = [1, 2, 3, 4];
    foreach ($arr as $k => $v) {
        $v = &$arr[$k];
        print_r($arr);
    }
}

t6();


function t7()
{
    $arr = [1 => 5, 5 => 8, 22, 2 => '8', 81];
    print_r($arr);
}
t7();