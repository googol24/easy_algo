<?php

// 自动加载
spl_autoload_register(
    function ($class) {
        include_once "{$class}.php";
    }
);

// 首先准备结点
$nodeA = new BinaryTreeNode('A');
$nodeB = new BinaryTreeNode('B');
$nodeC = new BinaryTreeNode('C');
$nodeD = new BinaryTreeNode('D');
$nodeE = new BinaryTreeNode('E');
$nodeF = new BinaryTreeNode('F');
$nodeG = new BinaryTreeNode('G');

// 以A结点为根节点建立二叉树
/*
 *             A
 *       B             C
 *   D            E         F
 *                   G
*/
$binTree = new BinaryTree($nodeA);

$nodeA->setLChildNode($nodeB);
$nodeA->setRChildNode($nodeC);

$nodeB->setLChildNode($nodeD);

$nodeC->setLChildNode($nodeE);
$nodeC->setRChildNode($nodeF);

$nodeE->setRChildNode($nodeG);

// 遍历二叉树（先序、中序、后序、深度优先）
echo '先序遍历：';
$binTree->preOrderPrint();

echo PHP_EOL . '中序遍历：';
$binTree->inOrderPrint();

echo PHP_EOL . '后序遍历：';
$binTree->postOrderPrint();

echo PHP_EOL . '广度优先遍历：';
$binTree->levelOrderPrint();

echo PHP_EOL . '二叉树深度：' . $binTree->getDepth();

echo PHP_EOL . '二叉树宽度：' . $binTree->getWidth();