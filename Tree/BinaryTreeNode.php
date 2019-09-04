<?php

/**
 * 二叉树节点类
 *
 * @author zhangzhengkun
 */
class BinaryTreeNode
{
    /**
     * 结点值
     *
     * @var string
     */
    private $value;

    /**
     * 左孩子指针
     *
     * @var BinaryTreeNode
     */
    private $lChild;

    /**
     * 右孩子指针
     *
     * @var BinaryTreeNode
     */
    private $rChild;

    /**
     * 初始化一个结点
     *
     * @param string $val
     */
    public function __construct($val)
    {
        $this->value  = $val;
        $this->lChild = null;
        $this->rChild = null;
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
     * 设置左孩子结点指针
     *
     * @param BinaryTreeNode $node
     *
     */
    public function setLChildNode($node)
    {
        $this->lChild = $node;
    }

    /**
     * 获取左孩子结点
     *
     * @return BinaryTreeNode|null
     *
     */
    public function getLChildNode()
    {
        return $this->lChild;
    }

    /**
     * 设置右孩子结点指针
     *
     * @param BinaryTreeNode $node
     *
     */
    public function setRChildNode($node)
    {
        $this->rChild = $node;
    }

    /**
     * 获取右孩子结点
     *
     * @return BinaryTreeNode|null
     *
     */
    public function getRChildNode()
    {
        return $this->rChild;
    }
}