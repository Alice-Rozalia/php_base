<?php
$stu = ['啊', '是', '的'];

// 复位指针
reset($stu);
while (key($stu) !== null) {
    // 获取健-值
    echo key($stu), '-', current($stu), '<br>';
    // 指针下移
    next($stu);
}

// 定义类实现迭代器接口
class MyClass implements Iterator {
    // $list属性用来保存学生数组
    private $list = array();

    // 添加学生
    public function addStu($name) {
        $this->list[] = $name;
    }

    // 实现接口中的复位方法
    public function rewind() {
        reset($this->list);
    }

    // 验证当前指针是否合法
    public function valid() {
        return key($this->list) !== null;
    }

    // 获取值
    public function current() {
        return current($this->list);
    }

    // 获取健
    public function key() {
        return key($this->list);
    }

    // 指针下移
    public function next() {
        next($this->list);
    }
}

$class = new MyClass();
$class->addStu('1');
$class->addStu('3');
$class->addStu('2');
// 遍历
foreach ($class as $k => $stu) {
    echo "{$k} - {$stu}<br>";
}