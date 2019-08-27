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