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


    public function t5($n, $m)
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


    public function t9(string $dir, string $mode): bool
    {
        if (is_dir($dir)) {
            return true;
        }
        return mkdir($dir, $mode, true);
    }


    public function lock()
    {
        $fp = fopen('demo.txt', 'a+');
        if (flock($fp, LOCK_EX | LOCK_NB)) {
            sleep(10);
            fwrite($fp, time() . '.....' . PHP_EOL);
            flock($fp, LOCK_UN);
        } else {
            echo 'locked....';
            echo PHP_EOL;
        }

        fclose($fp);

    }

}


$o = new t();
//$o->t1();
//$o->t2();
//$ret = $o->t3('./Models');
//print_r($ret);


//print_r($o->t4(18, 81));
//echo PHP_EOL;

echo $o->t5(11, 4);
echo PHP_EOL;

//echo $o->king(12, 4);
//echo PHP_EOL;

$arr = [
    ['id' => 1, 'pid' => 0, 'name' => '数码'],
    ['id' => 2, 'pid' => 0, 'name' => '电器'],
    ['id' => 3, 'pid' => 0, 'name' => '服装'],
    ['id' => 4, 'pid' => 1, 'name' => '手机'],
    ['id' => 5, 'pid' => 1, 'name' => '电脑'],
    ['id' => 6, 'pid' => 2, 'name' => '电视'],
    ['id' => 7, 'pid' => 2, 'name' => '冰箱'],
    ['id' => 8, 'pid' => 3, 'name' => '男装'],
    ['id' => 9, 'pid' => 3, 'name' => '女装'],
    ['id' => 10, 'pid' => 9, 'name' => '长裙'],
    ['id' => 11, 'pid' => 9, 'name' => '短裙'],
];
//$res = $o->getTree($arr, 0);
//print_r($res);

//include 'Common/Pager.php';
//$b = new \Common\Pager(2, 5);
//$b->page();
//$o->t9('./p/p1/p2/p3/p4/p5/p6', '777');
//$o->lock();


//function url()
//{
//    $url = 'https://www.seeedstudio.com/fusion/opl.zip';
//    print_r ($parse = parse_url($url));
//    print_r($name = basename($parse['path']));
//    print_r($exp = explode('.',$name));
//    print_r($exp[1]);
//}
//
//echo url();


function url2()
{
    $url = 'https://www.seeedstudio.com/fusion/opl.zip';
    print_r($parse = parse_url($url));
    print_r($name = basename($parse['path']));
    list(, $exp) = explode('.', $name);
    print_r($exp);
    echo PHP_EOL;
}

url2();
echo PHP_EOL;

//echo date('d/m/Y', strtotime('02/28/2019'));

echo PHP_EOL;

(function () {
    for ($i = 1; $i <= 9; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo "$j*$i=" . $i * $j . " ";
        }
        echo PHP_EOL;
    }
})();

echo PHP_EOL;
(function ($arr) {
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = $i + 1; $j < count($arr); $j++) {
            if ($arr[$i] > $arr[$j]) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }
    print_r($arr);
})([8, 3, 4, 5, 889, 36, 343, 9, 12, 45, 67, 18]);
echo PHP_EOL;


$fun = function ($path) use (&$fun) {
    $files = [];
    if ($handler = @opendir($path)) {
        while (($file = @readdir($handler)) !== false) {
            if (is_dir($path . '/' . $file) && $file != '.' && $file != '..') {
                $files[$file] = $fun($path . '/' . $file);
            } else {
                $files[] = $file;
            }
        }
    }
    return $files;
};
$result = $fun('.');
//print_r($result);

echo PHP_EOL;

echo (function ($n, $m) {
    $arr = range(1, $n);
    $i = 1;
    while (count($arr) > 1) {
        if ($i % $m != 0) {
            array_push($arr, $arr[$i - 1]);
        }
        unset($arr[$i - 1]);
        $i++;
    }
    return $arr[$i - 1];
})(11, 4);
echo PHP_EOL;

$tree = function ($arr, $pid) use (&$tree) {
    $result = [];
    foreach ($arr as $cate) {
        if ($cate['pid'] == $pid) {
            $cate['child'] = $tree($arr, $cate['id']);
            $result[] = $cate;
        }
    }
    return $result;
};

//print_r($tree($arr, 0));

echo PHP_EOL;


(function () {
    $fp = fopen('lock.lock', 'a+');
    if (flock($fp, LOCK_EX | LOCK_NB)) {
        usleep(10);
        fwrite($fp, time() . '.....' . PHP_EOL);
        flock($fp, LOCK_UN);
    } else {
        echo 'get lock fail...' . PHP_EOL;
    }
})();
echo PHP_EOL;

echo uniqid(':::::', '1111');
echo PHP_EOL;


class Single
{

    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new  self();
        }
        return self::$instance;
    }
}

var_dump(Single::getInstance());
var_dump(Single::getInstance());


class Factory
{
    public static function getObj($type)
    {
        switch ($type) {
            case 'Dog':
                return new Dog();
            case 'Cat':
                return new Cat();
        }
    }
}

class Dog
{
    public function get()
    {
        echo 'I\'m dog ...';
        echo PHP_EOL;
    }
}

class Cat
{
    public function get()
    {
        echo 'I\'m cat ...';
        echo PHP_EOL;
    }
}


$obj = Factory::getObj('Dog');
$obj->get();
echo PHP_EOL;


class Register
{
    private static $objects = [];

    public static function _set($alias, $val)
    {
        self::$objects[$alias] = $val;
    }

    public static function _get($alias)
    {
        return self::$objects[$alias];
    }

    public static function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}

Register::_set('Dog', Factory::getObj('Dog'));
Register::_set('Cat', Factory::getObj('Cat'));

(Register::_get('Dog'))->get();
(Register::_get('Cat'))->get();


interface IOb
{
    public function update();
}

abstract class Ob
{
    public abstract function trigger();

    private $observer = [];

    public function register(IOb $ob)
    {
        $this->observer[] = $ob;
    }

    public function notify()
    {
        foreach ($this->observer as $ob) {
            $ob->update();
        }
    }
}

class Ob1 implements IOb
{
    public function update()
    {
        echo 'ob1';
        echo PHP_EOL;
    }
}

class Ob2 implements IOb
{
    public function update()
    {
        echo 'ob2';
        echo PHP_EOL;
    }
}

class ObTest extends Ob
{
    public function trigger()
    {
        $this->notify();
    }
}

//创建一个事件
$event = new ObTest();
//为事件增加旁观者
$event->register(new Ob1());
$event->register(new Ob2());
//执行事件 通知旁观者
$event->trigger();


(function (\Closure $fun) {
    echo ($fun())();
    echo PHP_EOL;
})(function () {
    return function () {
        return 'def';
    };
});

echo PHP_EOL;
$w1 = 456;
$w2 = &$w1;
$w1 = 789;
unset($w1);
var_dump($w1);
var_dump($w2);
echo PHP_EOL;


$l = 10;
(function (&$k) {
    print_r($k);
    $k += 99;
    echo PHP_EOL;
})($l);
var_dump($l);
echo PHP_EOL;


(function () {
    global $l;
    echo $l;
})();
echo PHP_EOL;


(function () {
    $fp = fopen('lock.lock', 'a+');
    if (flock($fp, LOCK_EX | LOCK_NB)) {
        echo 'do something...';
        //sleep(5);
        fwrite($fp, '...........' . PHP_EOL);
        echo PHP_EOL;
    } else {
        echo 'please wait...';
        echo PHP_EOL;
    }
    flock($fp, LOCK_UN);
    fclose($fp);
})();


(function () {
    $fp = fopen('lock.lock', 'r');
    if (flock($fp, LOCK_SH)) {
        //sleep(5);
        $ret = '';
        while (!feof($fp)) {
            $ret .= fgets($fp);
        }
        echo PHP_EOL;
    } else {
        echo 'please wait...';
        echo PHP_EOL;
    }
    flock($fp, LOCK_UN);
    fclose($fp);
    echo $ret;
})();

$s1 = 'ddd';
$s2 = 'fff';
echo $s1+$s2;
echo PHP_EOL;

echo strcmp($s1,'ddd');echo PHP_EOL;

$j = '1234';
var_dump($j{1});
