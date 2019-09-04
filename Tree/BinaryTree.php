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
     * 广度优先遍历输出
     * 借助队列
     *
     * 例如：首先将根节点A插入队列中，队列中有元素（A）;
     * 将A节点弹出，同时将A节点的左、右节点依次插入队列，B在队首，C在队尾，（B，C），此时得到A节点；
     * 继续弹出队首元素，即弹出B，并将B的左、右节点插入队列，C在队首，E在队尾（C,D，E），此时得到B节点；
     * 继续弹出，即弹出C，并将C节点的左、中、右节点依次插入队列，（D,E,F,G,H），此时得到C节点；
     * 将D弹出，此时D没有子节点，队列中元素为（E,F,G,H），得到D节点；
     * 以此类推
     */
    public function levelOrderPrint()
    {
        $queue = [];

        if (!empty($this->rootNode)) {
            array_push($queue, $this->rootNode);
        }

        while (!empty($queue)) {
            /** @var BinaryTreeNode $node */
            $node = array_shift($queue);

            // 打印结点
            echo $node->getNodeValue() . ' ';

            if ($node->getLChildNode()) {
                array_push($queue, $node->getLChildNode());
            }

            if ($node->getRChildNode()) {
                array_push($queue, $node->getRChildNode());
            }
        }
    }

    /**
     * 获取深度
     *
     * @return int
     *
     */
    public function getDepth()
    {
        return $this->getDepthOfNode($this->rootNode);
    }

    /**
     * 递归获取指定结点的深度
     *
     * @param BinaryTreeNode $node
     *
     * @return int
     *
     */
    private function getDepthOfNode($node)
    {
        if (!$node) {
            return 0;
        }

        return 1 + max(
                $this->getDepthOfNode($node->getLChildNode()),
                $this->getDepthOfNode($node->getRChildNode())
            );
    }

    /**
     * 获取宽度
     * 借助队列
     *
     * @return int
     *
     */
    public function getWidth()
    {
        $queue = [];

        if (!empty($this->rootNode)) {
            array_push($queue, $this->rootNode);
        }

        $width = 0;

        while (!empty($queue)) {
            /** @var BinaryTreeNode $node */
            $node = array_shift($queue);

            if ($node->getLChildNode()) {
                array_push($queue, $node->getLChildNode());
            }

            if ($node->getRChildNode()) {
                array_push($queue, $node->getRChildNode());
            }

            $width = max($width, count($queue));
        }

        return $width;
    }

    /**
     * 获取二叉树的叶子节点个数
     *
     * @return int
     *
     */
    public function getLeafNumber()
    {
        return $this->getLeafNumberOfNode($this->rootNode);
    }

    /**
     * 递归根据某个结点获取以该结点为根的子树中的叶节点的数目
     *
     * @param BinaryTreeNode $node
     *
     * @return int
     *
     */
    private function getLeafNumberOfNode($node)
    {
        if (!$node) {
            return 0;
        }

        if (!$node->getLChildNode() && !$node->getRChildNode()) {
            return 1;
        }

        return $this->getLeafNumberOfNode($node->getLChildNode()) + $this->getLeafNumberOfNode($node->getRChildNode());
    }
}