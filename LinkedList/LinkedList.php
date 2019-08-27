<?php

/**
 * 单链表类
 *
 * @author zhangzhengkun
 */
class LinkedList
{
    /**
     * 头结点
     *
     * @var Node
     */
    private $head;

    /**
     * 初始化一个单链表
     */
    public function __construct()
    {
        $this->head = new Node('HEAD');
    }

    /**
     * 头插法添加结点
     *
     * @param Node $newNode
     *
     */
    public function addNodeToHead($newNode)
    {
        $newNode->setNextNode($this->head->getNextNode());
        $this->head->setNextNode($newNode);
    }

    /**
     * 打印显示链表
     */
    public function printLinkedList()
    {
        echo '链表为：';

        $pNode = $this->head;

        while ($pNode) {
            echo $pNode->getNodeValue();

            if ($pNode->getNextNode()) {
                echo '->';
            }

            $pNode = $pNode->getNextNode();
        }

        echo PHP_EOL;
    }
}