<?php

class A {
    // protected 在整个继承链上访问
    protected $num = 10;
}

class B extends A {
    public function getNum() {
        echo $this->num;
    }
}

$obj = new B();
$obj->getNum();