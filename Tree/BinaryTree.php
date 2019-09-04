<?php

/**
 * 二叉树类
 *
 * @author zhangzhengkun
 */
class BinaryTree
{
    /**
     * 根节点
     *
     * @var BinaryTreeNode
     */
    private $rootNode;

    /**
     * 初始化一棵二叉树
     *
     * @param BinaryTreeNode $root
     */
    public function __construct($root)
    {
        $this->rootNode = $root;
    }

    /**
     * 先序遍历输出
     */
    public function preOrderPrint()
    {
        $this->preOrderTraverse($this->rootNode);
    }

    /**
     * 先序遍历
     *
     * @param BinaryTreeNode $rootNode
     *
     */
    private function preOrderTraverse($rootNode)
    {
        if ($rootNode) {

            echo $rootNode->getNodeValue() . ' ';

            $this->preOrderTraverse($rootNode->getLChildNode());

            $this->preOrderTraverse($rootNode->getRChildNode());
        }
    }

    /**
     * 中序遍历输出
     */
    public function inOrderPrint()
    {
        $this->inOrderTraverse($this->rootNode);
    }

    /**
     * 中序遍历
     *
     * @param BinaryTreeNode $node
     *
     */
    private function inOrderTraverse($node)
    {
        if ($node) {

            $this->inOrderTraverse($node->getLChildNode());

            echo $node->getNodeValue() . ' ';

            $this->inOrderTraverse($node->getRChildNode());
        }
    }

    /**
     * 后序遍历输出
     *
     */
    public function postOrderPrint()
    {
        $this->postOrderTraverse($this->rootNode);
    }

    /**
     * 后序遍历
     *
     * @param BinaryTreeNode $node
     *
     */
    private function postOrderTraverse($node)
    {
        if ($node) {

            $this->postOrderTraverse($node->getLChildNode());

            $this->postOrderTraverse($node->getRChildNode());

            echo $node->getNodeValue() . ' ';
        }
    }

    /**
     * 深度优先遍历输出
     */
    public function depthOrderPrint()
    {

    }
}