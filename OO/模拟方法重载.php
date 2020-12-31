<?php

class Math {
    public function __call($name, $arguments) {
        $sum = 0;
        foreach ($arguments as $v) {
            $sum += $v;
        }
        echo implode(',', $arguments) . '的和是' . $sum, '<br>';
    }
}

$math = new Math();
$math->call(10, 20);
$math->call(10, 20, 30);
$math->call(10, 20, 30, 40);