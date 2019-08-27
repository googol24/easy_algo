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

// 查找倒数第k个结点
echo '倒数第3个结点：' . $list->getKthLastNode(3)->getNodeValue() . PHP_EOL;

// 构造一个有环链表
$ringList = new LinkedList();
$ringList->addNodeToTail(new Node(1));
$ringList->addNodeToTail(new Node(2));
$ringList->addNodeToTail(new Node(3));
$ringList->addNodeToTail(new Node(4));
$ringList->addNodeToTail(new Node(5));
$ringList->addNodeToTail(new Node(6));

// 设置环
$ringList->getTailNode()->setNextNode($ringList->getMiddleNode());

// 判断是否有环
echo 'list是否有环：' . ($list->hasRing() ? '是' : '否') . PHP_EOL;
echo 'ringList是否有环：' . ($ringList->hasRing() ? '是' : '否') . PHP_EOL;