<?php
$dsn = "mysql:host=localhost;port=3306;dbname=php_wish;charset=utf8";
$pdo = new PDO($dsn, 'root', '123456');

$stmt = $pdo->query("select * from news");

//$rs = $stmt->fetchAll(2); // 关联数组
//$rs = $stmt->fetchAll(PDO::FETCH_OBJ); // 返回对象数组
//echo '<pre>';
//var_dump($rs);

echo $stmt->rowCount(), '<br>'; // 总行数

foreach ($stmt as $row) {
    echo $row['title'], '<br>';
}