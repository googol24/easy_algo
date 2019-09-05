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

// 二叉树的其他基本操作
echo PHP_EOL . '二叉树深度：' . $binTree->getDepth();

echo PHP_EOL . '二叉树宽度：' . $binTree->getWidth();

echo PHP_EOL . '二叉树中叶节点的个数：' . $binTree->getLeafNumber();

echo PHP_EOL . '二叉树中E、G结点的公共最近祖先结点：' . $binTree->findLCA($nodeE, $nodeG)->getNodeValue();
echo PHP_EOL . '二叉树中E、F结点的公共最近祖先结点：' . $binTree->findLCA($nodeE, $nodeF)->getNodeValue();
echo PHP_EOL . '二叉树中E、D结点的公共最近祖先结点：' . $binTree->findLCA($nodeE, $nodeD)->getNodeValue();

echo PHP_EOL . '二叉树中E结点的父节点：' . $binTree->getParentNode($nodeE)->getNodeValue();
echo PHP_EOL . '二叉树中G结点的父节点：' . $binTree->getParentNode($nodeG)->getNodeValue();
echo PHP_EOL . '二叉树中B结点的父节点：' . $binTree->getParentNode($nodeB)->getNodeValue();

echo PHP_EOL . '二叉树中G结点的所有祖先结点：' . implode(',', $binTree->getNodeValues($binTree->getAllAncestors($nodeG)));
echo PHP_EOL . '二叉树中D结点的所有祖先结点：' . implode(',', $binTree->getNodeValues($binTree->getAllAncestors($nodeD)));
echo PHP_EOL . '二叉树中C结点的所有祖先结点：' . implode(',', $binTree->getNodeValues($binTree->getAllAncestors($nodeC)));