<?php

// 快速排序
$unSortedArray = [
    7, 4, 8, 2, 9, 1, 6, 3, 0, 5
];

print_r(quickSort($unSortedArray));

function quickSort($arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }

    // 枢值元素
    $pivot = $arr[0];

    // 初始化左右区间
    $leftArr = $rightArr = [];

    // 分配左右区间
    for ($i=1; $i<count($arr); $i++) {
        if ($pivot < $arr[$i]) {
            $rightArr[] = $arr[$i];
        } else {
            $leftArr[] = $arr[$i];
        }
    }

    // 左右区间递归排序
    $leftArr = quickSort($leftArr);
    $rightArr = quickSort($rightArr);

    // 合并排序结果
    return array_merge($leftArr, [$pivot], $rightArr);
}