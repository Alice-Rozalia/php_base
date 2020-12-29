<?php
// 错误处理

/**
 * 错误级别：
 * 1. notice：提示
 * 2. warning：警告
 * 3. error： 错误
 *
 * notice和warning报错之后继续执行，error则停止执行
 */

$debug = true; // true：开发模式，false：运行模式
ini_set('error_reporting', E_ALL); // 报告所有的错误
if ($debug) {
    ini_set('display_errors', 'on'); // 错误显示在浏览器上
    ini_set('log_errors', 'off'); // 不报错日志
} else {
    ini_set('display_errors', 'off');
    ini_set('log_errors', 'on');
    ini_set('error_log', './err.log'); // 错误日志保存地址
}

function fn() {
    echo 5 / 0;
}
// fn();

# 自定义错误（了解）
trigger_error('自定义错误！'); // notice 级别
trigger_error('自定义错误！', E_USER_WARNING); // warning 级别
trigger_error('自定义错误！', E_USER_ERROR); // error 级别