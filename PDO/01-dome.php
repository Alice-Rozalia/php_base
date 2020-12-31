<?php
$dsn = "mysql:host=localhost;port=3306;dbname=php_wish;charset=utf8";
$pdo = new PDO($dsn, 'root', '123456');

$sql = "insert into news values (null, '天国')";
$result = $pdo->exec($sql);
if ($result) {
    echo 'SQL语句执行成功！';
    if (substr($sql, 0, 6) == 'insert')
        echo '自动增长的编号是：' . $pdo->lastInsertId(), '<br>';
    else
        echo '受到影响的行数是：' . $result, '<br>';
} elseif ($result === 0) {
    echo '数据没有变化<br>';
} elseif ($result === false) {
    echo 'SQL语句执行失败<br>';
    echo '错误编码：' . $pdo->errorCode(), '<br>';
}