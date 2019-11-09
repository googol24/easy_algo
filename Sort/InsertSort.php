<?php

// 直接插入排序
$unSortedArray = [
    7, 4, 8, 2, 9, 1, 6, 3, 0, 5
];

print_r(insertSort($unSortedArray));

function insertSort($arr)
{
    $len = count($arr);

    for ($i=1; $i<$len; $i++) {
        $temp = $arr[$i];
        for ($j=$i-1; $j>=0; $j--) {
            if ($temp < $arr[$j]) {
                $arr[$j+1] = $arr[$j];
                $arr[$j] = $temp;
            } else {
                break;
            }
        }
    }

    return $arr;
}