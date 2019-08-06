<?php

// 测试程序

// 自动加载
spl_autoload_register(function ($class) {
    if (is_file($class . '.php')) {
        require_once __DIR__ . '/' . "$class.php";
    }
});

$stack = new Stack();

echo '入栈：' . PHP_EOL;
$stack->push(3);
$stack->push(2);
$stack->push(5);
$stack->push(1);
$stack->push(4);

print_r($stack->getStackInfo());
print_r($stack->getMinStackInfo());
echo '最小元素：' . $stack->getMinElement() . PHP_EOL;

echo PHP_EOL . '出栈：' . PHP_EOL;
print_r($stack->pop());
print_r($stack->pop());

print_r($stack->getStackInfo());
print_r($stack->getMinStackInfo());
echo '最小元素：' . $stack->getMinElement() . PHP_EOL;

