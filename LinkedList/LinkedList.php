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
     * 尾插法添加结点
     *
     * @param Node $newNode
     *
     */
    public function addNodeToTail($newNode)
    {
        // 寻找尾部指针
        $tail = $this->head;

        while ($tail->getNextNode()) {
            $tail = $tail->getNextNode();
        }

        // 尾部插入
        $tail->setNextNode($newNode);
    }

    /**
     * 根据指定关键词查找结点（只查找第一次匹配）
     *
     * @param string $value
     *
     * @return Node|null
     *
     */
    public function findNode($value)
    {
        $p = $this->head;

        $result = null;

        while ($p->getNextNode()) {
            $p = $p->getNextNode();
            if ($p->getNodeValue() == $value) {
                $result = $p->getNextNode();
                break;
            }
        }

        return $result;
    }

    /**
     * 根据指定关键词查找指定结点的前驱结点（只查找第一次匹配）
     *
     * @param string $value
     *
     * @return Node|null
     *
     */
    public function findPrevious($value)
    {
        $p = $this->head;

        $result = null;

        while ($p->getNextNode()) {

            if ($p->getNextNode()->getNodeValue() == $value) {
                $result = $p;
                break;
            }

            $p = $p->getNextNode();
        }

        return $result;
    }

    /**
     * 删除指定值的结点（只删除第一个）
     *
     * @param string $value
     *
     * @return mixed
     */
    public function deleteNode($value)
    {
        $previousNode = $this->findPrevious($value);

        if ($previousNode) {
            $previousNode->setNextNode($previousNode->getNextNode()->getNextNode());
        }
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