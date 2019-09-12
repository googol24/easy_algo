<?php

/**
 * 二分查找
 *
 * @param array $arr 指定的有序数组
 * @param int $key 待查找的关键字
 *
 * @return bool|float
 *
 */
function binarySearch($arr, $key)
{
    $low  = 0;
    $high = count($arr) - 1;

    while ($low <= $high) {
        $mid = intval(($low + $high) / 2);

        if ($arr[$mid] == $key) {
            return $mid;
        } elseif ($arr[$mid] > $key) {
            $high = $mid - 1;
        } else {
            $low  = $mid + 1;
        }
    }

    return false;
}

$arr = [1, 3, 5, 7 ,9, 11];
var_dump(binarySearch($arr, 9));
var_dump(binarySearch($arr, 10));