<?php
// 递归

function printer($num)
{
    echo $num, "<br>";
    if ($num == 1) {
        return;
    }
    printer($num - 1);
}

printer(9);



// 打印第5个斐波那契数
function fbnq($n) {
    if ($n == 1 || $n == 2)
        return 1;
    return fbnq($n - 1) + fbnq($n - 2);
}
echo fbnq(5);
