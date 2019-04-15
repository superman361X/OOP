<?php

namespace Controller;


use function Common\dump;

class Calc extends Base
{
    /**
     * 冒泡排序原理：
     * 依次比较相邻的两个数，然后根据大小做出排序，直至最后两位数。
     * 由于在排序过程中总是小数往前放，大数往后放，相当于气泡往上升，所以称作冒泡排序。
     * 但其实在实际过程中也可以根据自己需要反过来用，大树往前放，小数往后放。
     */
    public function calc1()
    {
        // 定义一个随机的数组
        $arr = [8, 4, 6, 7, 1];
        $count = count($arr);
        // 第一层可以理解为从数组中键为0开始循环到最后一个
        for ($i = 0; $i < $count; $i++) {
            // 第二层为从$i+1的地方循环到数组最后
            for ($j = $i + 1; $j < $count; $j++) {
                // 比较数组中两个相邻值的大小
                if ($arr[$i] > $arr[$j]) {
                    $temp = $arr[$i]; // 这里临时变量，存贮$i的值
                    $arr[$i] = $arr[$j]; // 第一次更换位置
                    $arr[$j] = $temp; // 完成位置互换
                }
            }
        }

        dump($arr);
    }


    /**
     * 选择排序原理：
     * 在一列数字中，选出最小数与第一个位置的数交换。
     * 然后在剩下的数当中再找最小的与第二个位置的数交换，如此循环到倒数第二个数和最后一个数比较为止。(以下都是升序排列，即从小到大排列)
     */

    public function calc2()
    {
        $arr = [8, 4, 6, 7, 1];
        $count = count($arr);
        for ($i = 0; $i < $count - 1; $i++) {
            //定义最小位置
            $p = $i;
            for ($j = $i + 1; $j < $count; $j++) {
                if ($arr[$j] < $arr[$p]) {
                    $p = $j;
                }
            }
            if ($i != $p) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$p];
                $arr[$p] = $temp;

            }
        }

        dump($arr);
    }


    public function calc3($m = 100, $n = 7)
    {
        $arr = range(1, $n);
        $i = 0;
        while (count($arr) > 1) {
            //遍历数组，判断当前猴子是否为出局序号，如果是则出局，否则放到数组最后
            (($i + 1) % $m != 0) && array_push($arr, $arr[$i]);
            unset($arr[$i]);
            $i++;
        }
        return $arr[$i];
    }

}