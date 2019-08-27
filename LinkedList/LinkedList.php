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
     * 查找单链表的中间结点
     *
     * @return Node|null
     *
     */
    public function getMiddleNode()
    {
        $slowPointer = $this->head;
        $fastPointer = $slowPointer;

        while ($slowPointer->getNextNode() && $fastPointer->getNextNode() && $fastPointer->getNextNode()->getNextNode()) {
            $slowPointer = $slowPointer->getNextNode();
            $fastPointer = $fastPointer->getNextNode()->getNextNode();
        }

        return $slowPointer;
    }

    /**
     * 单链表的就地逆置（反转）
     * 思想：采用头插法以及辅助指针，空间复杂度O(1)
     */
    public function reverse()
    {
        // 当链表不为空时
        if ($this->head->getNextNode()) {

            // 遍历指针
            $p = $this->head->getNextNode();

            // 断链
            $this->head->setNextNode(null);

            while ($p) {
                // 辅助指针
                $q = $p->getNextNode();

                // 头插法
                $p->setNextNode($this->head->getNextNode());
                $this->head->setNextNode($p);

                // 前进
                $p = $q;
            }
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