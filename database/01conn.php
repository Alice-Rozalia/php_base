<?php
$link = @mysqli_connect('localhost', 'root', '123456', 'php_wish');
# var_dump($link); // object(mysqli)

if (mysqli_connect_error()) {
    echo '错误编号：' . mysqli_connect_errno(), '<br>';
    echo '错误信息' . mysqli_connect_error();
    exit;
}

// 与数据库相关用 utf8，与页面相关用 utf-8
mysqli_set_charset($link, 'utf8');

// 执行insert，执行成功返回true
$result = mysqli_query($link, "insert into news values (null, '鸟之诗')");
var_dump($result);


// 执行update语句，执行成功返回true
$rs = mysqli_query($link, "update news set title = '红莲' where id = 1");
if ($rs) {
    echo '受影响的记录数: ' . mysqli_affected_rows();
} else {
    echo '错误码：' . mysqli_errno();
}

// delete语句
mysqli_query($link, "delete from news where id = 1");