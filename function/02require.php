<?php
echo "return 只能中断当前页面", "<br>";
require './01typeConstraint.php';
echo "如果想要完全终止脚本执行，使用exit()、或die()", "<br>";

// return返回页面结果，在项目中引入配置文件就使用这种方法
$peo = require './03test.php';
print_r($peo);