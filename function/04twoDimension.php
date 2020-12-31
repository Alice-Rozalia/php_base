<?php
// 遍历二维数组
$stu = [
    [1, 2, 3, 4],
    [10, 20, 30, 50]
];

for ($i = 0; $i < count($stu); $i++) {
    for ($j = 0; $j < count($stu[$i]); $j++) {
        echo $stu[$i][$j], "&nbsp;";
    }
    echo "<br>";
}