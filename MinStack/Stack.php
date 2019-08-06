<?php

/**
 * 最小栈类
 *
 * @author googol24
 */
class Stack
{
    /**
     * 栈顶指针（表示栈顶元素的上一个位置，空栈时指针指向位置0）
     *
     * @var int
     */
    protected $top = 0;

    /**
     * 栈内元素
     *
     * @var array
     */
    protected $elements = [];

    /**
     * 记录最小值的栈元素
     *
     * @var array
     */
    protected $minElements = [];

    /**
     * 压栈
     *
     *      加与所给栈相同大小的栈实现(复杂度小但占空间)
     *
     *      添加的栈只指示当前栈最小值
     *      例：elements  minElements
     *          4            2
     *          2            2
     *          8            7
     &          7            7
     *
     * @param mixed $e
     *
     */
    public function push($e)
    {
        $this->elements[$this->top] = $e;

        // 栈顶元素下标
        $topIndex = $this->top - 1;

        if (($topIndex < 0) || $this->minElements[$topIndex] > $e) {
            $this->minElements[$this->top] = $e;
        } else {
            $this->minElements[$this->top] = $this->minElements[$topIndex];
        }

        $this->top ++;
    }

    /**
     * 出栈
     *
     * @return mixed
     *
     */
    public function pop()
    {
        // 栈顶元素下标
        $topIndex = $this->top - 1;

        if ($topIndex < 0) {
            // 空栈
            return null;
        }

        $topElement = $this->elements[$topIndex];

        unset($this->elements[$topIndex]);

        unset($this->minElements[$topIndex]);

        $this->top --;

        return $topElement;
    }

    /**
     * 获取栈内的最小元素
     *
     * @return mixed
     *
     */
    public function getMinElement()
    {
        // 栈顶元素下标
        $topIndex = $this->top - 1;

        return $this->minElements[$topIndex];
    }

    /**
     * 获取栈
     *
     * @return array
     *
     */
    public function getStackInfo()
    {
        return $this->elements;
    }

    /**
     * 获取栈对应的最小元素栈
     *
     * @return array
     *
     */
    public function getMinStackInfo()
    {
        return $this->minElements;
    }
}