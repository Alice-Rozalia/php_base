<?php
# 创建目录
mkdir('./aa');

// 删除文件夹（删除的文件夹必须是空的）
rmdir('./aa');

// 重命名文件夹
rename('./aa', './bb');

// 是否是文件夹
is_dir('./bb');

// 打开文件夹
$folder = opendir('./');
var_dump($folder);

// 读取文件夹
readdir($folder);



// 将字符串写入文件，会覆盖重写，换行是\r\n
$str = "高森奈津美";
file_put_contents('./test.txt', $str);