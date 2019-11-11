<?php

// 基数排序
$arr = [
    20, 67, 123, 111, 2, 34, 1, 78, 0, 33, 11, 15, 83
];

$result = radixSort($arr);
print_r($result);

function radixSort($arr)
{
    // 排序轮数
    $maxDigits = getMaxDigits($arr);

    // 排序结果
    $tempArr = $arr;

    // 开始各轮排序
    for ($round = 0; $round < $maxDigits; $round ++) {
        // 初始化桶
        $bucketMap = initBucketMap();

        foreach ($tempArr as $item) {
            // 数据放入桶
            $flag = ($item / pow(10, $round)) % 10;
            $bucketMap[$flag][] = $item;
        }

        // 每轮结束之后给出顺序
        $tempArr = [];
        for ($i = 0; $i < 10; $i++) {
            foreach ($bucketMap[$i] as $item) {
                array_push($tempArr, $item);
            }
        }
    }

    // 排完之后放入数组
    return $tempArr;
}

function getMaxDigits($arr)
{
    $maxDigits = 0;

    foreach ($arr as $item) {
        $maxDigits = max($maxDigits, strlen($item));
    }

    return $maxDigits;
}

// 初始化桶
function initBucketMap()
{
    $bucketMap = [];

    for ($i = 0; $i < 10; $i++) {
        $bucketMap[$i] = [];
    }

    return $bucketMap;
}