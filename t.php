<?php

class t
{
    public function t1()
    {
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= $i; $j++) {
                echo $j . '*' . $i . '=' . $i * $j . ' ';
            }
            echo PHP_EOL;
        }
    }


    public function t2()
    {
        $arr = [1, 9, 45, 3, 55, 67, 2, 12];
        $count = count($arr);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if ($arr[$i] <= $arr[$j]) {
                    continue;
                }

                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }

        print_r($arr);
    }


    public function t3($dir = '.')
    {
        $files = [];
        if ($handle = @opendir($dir)) {
            while (($file = @readdir($handle)) !== false) {
                if (is_dir($dir . '/' . $file) && $file != '.' && $file != '..') {
                    $files[$file] = $this->t3($dir . '/' . $file);
                } else {
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        return $files;
    }


    public function t4($n, $m)
    {
        $arr = range(1, $n);
        $i = 0;
        while (count($arr) > 1) {
            //遍历数组，判断当前猴子是否为出局序号，如果是则出局，否则放到数组最后
            //(($i + 1) % $m != 0) && array_push($arr, $arr[$i]);
            if (($i + 1) % $m != 0) {
                array_push($arr, $arr[$i]);
            }
            unset($arr[$i]);
            $i++;
        }

        return $arr[$i];
    }


    function king($n, $m)
    {
        $arr = range(1, $n);
        //$arr = [2, 1, 3, 13, 4, 5, 9];
        $i = 1;//从1开始
        while (count($arr) > 1) {
            //遍历数组，判断当前猴子是否为出局序号，如果是则出局，否则放到数组最后
            if ($i % $m != 0) { //不出局
                array_push($arr, $arr[$i - 1]);
            }
            unset($arr[$i - 1]);
            $i++;//转移到下一个数组元素
        }
        return $arr[$i - 1];
    }

    public function t8()
    {
        static $i = 0;
        echo $i;
        $i++;
        if ($i < 10) {
            $this->t8();
        }
    }


    public function h()
    {
        $n = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $m = 3;
        $i = 1;
        while (count($n) > 1) {
            if ($i % $m != 0) {
                array_push($n, $n[$i - 1]);
            }
            unset($n[$i - 1]);
            $i++;
        }

        return $n[$i - 1];
    }



}


$o = new t();
//$o->t1();
//$o->t2();
//$ret = $o->t3('./Models');
//print_r($ret);


//print_r($o->t4(18, 81));
//echo PHP_EOL;

print_r($o->king(9, 3));
echo PHP_EOL;

print_r($o->h());
echo PHP_EOL;
//$o->t8();
//echo PHP_EOL;