<?php

// 自动加载
spl_autoload_register(function ($class) {
    if (is_file($class . '.php')) {
        require_once __DIR__ . '/' . "$class.php";
    }
});

// 初始化一个单链表
$list = new LinkedList();

// 查看一个空的单链表（只有头结点）
$list->printLinkedList();

// 添加结点（头插）
$list->addNodeToHead(new Node('a'));
$list->addNodeToHead(new Node('b'));
$list->addNodeToHead(new Node('c'));
$list->addNodeToHead(new Node('d'));
$list->addNodeToHead(new Node('e'));

// 查看单链表
$list->printLinkedList();

// 添加结点（尾插）
$list->addNodeToTail(new Node('f'));
$list->addNodeToTail(new Node('g'));
$list->addNodeToTail(new Node('h'));

// 查看单链表
$list->printLinkedList();

// 删除某个结点
$list->deleteNode('c');

// 查看单链表
$list->printLinkedList();

// 就地逆置该单链表
$list->reverse();

// 查看单链表
$list->printLinkedList();

// 查找单链表中间结点
$middleNode = $list->getMiddleNode();
echo '中间结点：' . $middleNode->getNodeValue() . PHP_EOL;