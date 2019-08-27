<?php

/**
 * 结点类
 *
 * @author zhangzhengkun
 */
class Node
{
    /**
     * 结点值
     *
     * @var string
     */
    private $value;

    /**
     * 后继指针
     *
     * @var Node
     */
    private $next;

    /**
     * 初始化一个结点
     *
     * @param string $val
     */
    public function __construct($val)
    {
        $this->value = $val;
        $this->next = null;
    }

    /**
     * 获取结点的值
     *
     * @return string
     *
     */
    public function getNodeValue()
    {
        return $this->value;
    }

    /**
     * 获取后继结点
     *
     * @return Node|null
     *
     */
    public function getNextNode()
    {
        return $this->next;
    }

    /**
     * 设置后继结点
     *
     * @param Node $node
     *
     */
    public function setNextNode($node)
    {
        $this->next = $node;
    }
}