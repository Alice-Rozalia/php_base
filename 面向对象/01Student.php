<?php

class Student {
    public $name;
    // 赋默认值
    public $age = '保密';
    private $sex;

    // 构造方法，当对象创建的时候自动执行
//    public function __construct($name, $age, $sex)
//    {
//        $this->name = $name;
//        $this->age = $age;
//        $this->sex = $sex;
//    }

    // 析构方法，当对象自动销毁的时候调用，不可以带参数
    public function __destruct() {

    }

    public function sing() {
        echo "月之虚", '<br>';
    }

    // public可以省略，默认就是public
    function test() {
        echo "月之虚", '<br>';
    }

    public function getSex() {
        return $this->sex;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }
}

// 类名不区分大小写
$stu = new Student();
$stu2 = new Student;  // 小括号可以省略

// 操作属性
// 1.给属性赋值
$stu->name = "高森奈津美";
$stu->age = 18;

// 2.获取属性值
echo '姓名：' . $stu->name, '<br>';
echo '年龄：' . $stu->age, '<br>';

// 3.添加属性
$stu->setSex('女');
$stu->add = "北京";
print_r($stu);

// 4.删除属性
unset($stu->add);
print_r($stu);

$stu->sing();

class Person extends Student {

}

$per = new Person();
echo $per->sing();