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


    function t5($n, $m)
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

    public function king($n, $m)
    {
        $arr = range(1, $n);
        $i = 0;
        while (count($arr) > 1) {
            if (($i + 1) % $m != 0) {
                array_push($arr, $arr[$i]);
            }

            unset($arr[$i]);
            $i++;
        }
        return $arr[$i];
    }


    public function getTree($data = [], $pid = 0)
    {
        $result = [];
        foreach ($data as $k => $cate) {

            if ($cate['pid'] == $pid) {
                //父亲找到儿子
                $cate['child'] = $this->getTree($data, $cate['id']);
                $result[] = $cate;
            }
        }

        return $result;
    }



}


$o = new t();
//$o->t1();
//$o->t2();
//$ret = $o->t3('./Models');
//print_r($ret);


//print_r($o->t4(18, 81));
//echo PHP_EOL;

//echo $o->t5(12, 4);
//echo PHP_EOL;
//
//echo $o->king(12, 4);
//echo PHP_EOL;

//$arr = [
//    ['id' => 1, 'pid' => 0, 'name' => '数码'],
//    ['id' => 2, 'pid' => 0, 'name' => '电器'],
//    ['id' => 3, 'pid' => 0, 'name' => '服装'],
//    ['id' => 4, 'pid' => 1, 'name' => '手机'],
//    ['id' => 5, 'pid' => 1, 'name' => '电脑'],
//    ['id' => 6, 'pid' => 2, 'name' => '电视'],
//    ['id' => 7, 'pid' => 2, 'name' => '冰箱'],
//    ['id' => 8, 'pid' => 3, 'name' => '男装'],
//    ['id' => 9, 'pid' => 3, 'name' => '女装'],
//    ['id' => 10, 'pid' => 9, 'name' => '长裙'],
//    ['id' => 11, 'pid' => 9, 'name' => '短裙'],
//];
//$res = $o->getTree($arr, 0);
//print_r($res);

//include 'Common/Pager.php';
//$b = new \Common\Pager(2, 5);
//$b->page();
