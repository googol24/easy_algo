<?php

// 堆排序
$unSortedArray = [
    7, 4, 8, 2, 9, 1, 6, 3, 0, 5
];

heapSort($unSortedArray);

print_r($unSortedArray);

function heapSort(&$arr)
{
    $len = count($arr);

    // 建初始堆
//    buildHeap($arr, $len);
    buildMaxHeap($arr, $len);

    // 取出堆顶元素，其余元素继续建堆，直至堆中只有一个元素
    for ($i = $len - 1; $i >= 1; $i--) {
        swap($arr, $i, 0);
//        buildHeap($arr, --$len);
        buildMaxHeap($arr, --$len);
    }
}

/**
 * 建堆（小顶堆）
 *
 * @param array $arr
 * @param int $size
 *
 * @return array
 */
function buildHeap(&$arr, $size)
{
    // 利用完全二叉树的特性，调整所有非叶节点
    for ($i = intval($size / 2) - 1; $i >= 0; $i--) {
        // 如果有左节点,将其下标存进最小值$min
        if ($i * 2 + 1 < $size) {
            $min = $i * 2 + 1;

            // 如果有右子结点,比较左右结点的大小,如果右子结点更小,将其结点的下标记录进最小值$min
            if ($i * 2 + 2 < $size) {
                if ($arr[$i * 2 + 2] < $arr[$min]) {
                    $min = $i * 2 + 2;
                }
            }
            // 将子结点中较小的和父结点比较,若子结点较小,与父结点交换位置,同时更新较小
            if ($arr[$min] < $arr[$i]) {
                swap($arr, $min, $i);
            }
        }
    }
}

/**
 * 建堆（大顶堆）
 *
 * @param array $arr
 * @param int $size
 *
 * @return array
 */
function buildMaxHeap(&$arr, $size)
{
    // 利用完全二叉树的特性，调整所有非叶节点
    for ($i = intval($size / 2) - 1; $i >= 0; $i--) {
        // 如果有左节点,将其下标存进最大值$max
        if ($i * 2 + 1 < $size) {
            $max = $i * 2 + 1;

            // 如果有右子结点,比较左右结点的大小,如果右子结点更小,将其结点的下标记录进最大值$max
            if ($i * 2 + 2 < $size) {
                if ($arr[$i * 2 + 2] > $arr[$max]) {
                    $max = $i * 2 + 2;
                }
            }
            // 将子结点中较大的和父结点比较,若子结点较小,与父结点交换位置,同时更新较大
            if ($arr[$max] > $arr[$i]) {
                swap($arr, $max, $i);
            }
        }
    }
}

/**
 * 交换数组元素
 *
 * @param array $arr
 * @param int $one
 * @param int $another
 */
function swap(&$arr, $one, $another)
{
    $temp = $arr[$one];
    $arr[$one] = $arr[$another];
    $arr[$another] = $temp;
}