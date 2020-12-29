<?php
// 类型约束
function fun(string $name, int $age)
{
    echo "姓名：{$name}", "<br>";
    echo "年龄：{$age}", "<br>";
}

// fun('高森奈津美', 'aa');  // 报错
// fun('高森奈津美', '18');  // 正常运行
fun('高森奈津美', 18);   // 正常运行

return;

// 约束返回值类型，可用约束string、int、float、bool、数组
// 返回值必须是整形
function ba(int $num1, int $num2): int
{
    return $num1 + $num2;
}

echo ba(1,2);


// 约束return后面不能有返回值，必须在php7.1以后的版本中才支持
function vo(): void {
    return;
}

vo();