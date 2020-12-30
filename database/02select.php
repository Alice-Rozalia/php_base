<?php
$link = @mysqli_connect('localhost', 'root', '123456', 'php_wish');

if (mysqli_connect_error()) {
    echo '错误编号：' . mysqli_connect_errno(), '<br>';
    echo '错误信息' . mysqli_connect_error();
    exit;
}

// mysqli_set_charset($link, 'utf8');
// 此种方式亦可设置编码
mysqli_query($link, 'set names utf8');

$result = mysqli_query($link, "select * from wish");
// var_dump($result);


echo '<pre>';
// 获取对象中的数据

// 1.将对象中的一条数据匹配成索引数组，之后指针下移1
// $row = mysqli_fetch_row($result);

// 2.数组下标为数据库字段名
// $row = mysqli_fetch_assoc($result);

// 3.既有字段名又有索引
// $row = mysqli_fetch_array($result);

// 4.总列数和总行数
// echo '总行数: ' . mysqli_num_rows($result), '<br>';
// cho '总列数: ' . mysqli_num_fields($result), '<br>';

// 5.获取所有数据
$row = mysqli_fetch_all($result);
print_r($row);

// 销毁结果集
mysqli_free_result($result);
// 关闭链接
mysqli_close($link);