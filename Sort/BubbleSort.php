<?php

// 冒泡排序

$unSortedArray = [
    7, 4, 8, 2, 9, 1, 6, 3, 0, 5
];

//$unSortedArray = [
//    23, 15, 43, 25, 54, 2, 6, 82, 11, 5, 21, 32, 65
//];

print_r($unSortedArray);

$sortedArray = bubbleSort($unSortedArray);

print_r($sortedArray);

// PHP 提供的排序方法
// print_r($unSortedArray);
// sort($unSortedArray);
// print_r($unSortedArray);

/**
 * 冒泡排序方法
 *
 * @param array $arr
 *
 * @return array
 *
 */
function bubbleSort($arr)
{
    $length = count($arr);

    for ($i = 0; $i < $length; $i++) {
        for ($j = $i + 1; $j < $length; $j ++) {
            if ($arr[$i] > $arr[$j]) {
                // swap
                $tempVal = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tempVal;
            }
        }
    }

    return $arr;
}