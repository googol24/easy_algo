<?php

// 希尔排序
$unSortedArray = [
    7, 4, 8, 2, 9, 1, 6, 3, 0, 5
];

print_r(shellSort($unSortedArray));

function shellSort($arr)
{
    $len = count($arr);

    $increment = $len;

    do {
        $increment = ceil($increment / 2);

        for ($i = $increment; $i < $len; $i++) {
            // 设置哨兵
            $temp = $arr[$i];

            // 将哨兵插入有序增量子表
            for ($j = $i - $increment; $j >= 0 && $arr[$j + $increment] < $arr[$j]; $j -= $increment) {
                // 记录后移
                $arr[$j + $increment] = $arr[$j];
            }

            $arr[$j + $increment] = $temp;
        }
    } while ($increment > 1);

    return $arr;
}