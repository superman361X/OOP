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
}


$o = new t();
$o->t1();
$o->t2();
$ret = $o->t3('./Models');
print_r($ret);