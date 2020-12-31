<?php
// 自动加载类
spl_autoload_register(function ($class_name) {
    require "./{$class_name}.class.php";
});

$param = array(
    'user' => 'root',
    'pwd' => '123456',
    'dbname' => 'php_wish'
);
// 获取单例
$db = MySQLDB::getInstance($param);
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,th,td {
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<?php
// 页面大小
$pageSize = 5;
// 总记录数
$rowCount = $db->fetchColumn("select count(*) from wish");
// 总页数
$total = ceil($rowCount[0] / $pageSize);
// 获取当前页
$pageno = $_GET['pageno'] ?? 1;
$startno = ($pageno - 1) * $pageSize;

//$sql = "select * from wish limit $startno, $pageSize";
$sql = "select * from wish where id >= (select id from wish limit $startno, 1) limit $pageSize";
$rs = $db->fetchAll($sql);
?>
<table>
    <tr>
        <th>编号</th>
        <th>名称</th>
        <th>内容</th>
    </tr>
    <?php foreach ($rs as $row): ?>
        <tr>
            <td><?=$row['id'] ?></td>
            <td><?=$row['name'] ?></td>
            <td><?=$row['content'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
for ($i = 1; $i <= $total; $i++): ?>
    <a href="?pageno=<?= $i ?>"><?= $i ?></a>
<?php endfor; ?>
</body>
</html>