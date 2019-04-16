<?php
echo date('Y年m月d日 H:i:s', strtotime('1 week'));
echo PHP_EOL;

echo $_SERVER['DOCUMENT_ROOT'];


list($a, $b) = explode('.', 'abc.jpg');
echo $b;
echo PHP_EOL;

$url = 'https://www.seeedstudio.com/a/b/c/d.png';
$s = parse_url($url);
list($a, $b) = explode('.', basename($s['path']));
echo $b;
echo PHP_EOL;


//$fp = fopen('https://www.seeedstudio.com', 'r');
//$s = stream_get_contents($fp);
//echo $s;


//$fp = file_get_contents('https://www.seeedstudio.com');
//echo $fp;

$a = array('1', '2', '3');
$b =& $a;
$a = array('a', 'b', 'c');
print_r($a);
print_r($b);

echo PHP_EOL;
echo "===============";
echo PHP_EOL;


//new XMLReader();
//
//simplexml_load_file('xx.xml');


$x = 'get_name_by_id';
$arr = explode('_',$x);
$new = '';
foreach ($arr as $v){
    $new .= ucfirst($v);
}
echo $new;
echo PHP_EOL;