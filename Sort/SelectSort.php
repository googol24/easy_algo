<?php

// 简单选择排序
$unSortedArray = [
    7, 4, 8, 2, 9, 1, 6, 3, 0, 5
];

print_r(selectSort($unSortedArray));

function selectSort($arr)
{
    $len = count($arr);

    for ($i = 0; $i < $len - 1; $i++) {
        // 记录第$i个元素后的所有元素最小值下标
        $min = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$j] < $arr[$min]) {
                $min = $j;
            }
        }

        if ($min != $i) {
            $temp = $arr[$min];
            $arr[$min] = $arr[$i];
            $arr[$i] = $temp;
        }
    }

    return $arr;
}