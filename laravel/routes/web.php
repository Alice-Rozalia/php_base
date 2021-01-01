<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 必选参数
Route::get('/home1/{id}', function ($id) {
    return "接收到的id是：${id}";
});

// 可选参数
Route::get('/home2/{id?}', function ($id = 0) {
    return "接收到的id是：${id}";
});

// 传统的参数传递
// 路由别名
Route::get('/home3', function () {
    $id = isset($_GET['id']) ? $_GET['id'] : '未传';
    return "接收到的id是：" . $id;
})->name('h');

// 路由群组
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', function () {
        return '匹配/admin/login';
    });

    Route::get('/index', function () {
        return '匹配/admin/index';
    });
});

// 控制器路由
Route::any('model1', 'TestController@mod_add');
Route::get('model2', 'TestController@mod_test1');
Route::post('model3', 'TestController@file');
Route::get('model4', 'TestController@page');
// 针对分目录管理的控制器路由，其中的目录分隔符在此处已经变成了命名空间分隔符，因此得使用 "\"
Route::get('test2', 'Admin\TestController@test1');

Route::get('test3', 'Admin\TestController@test2');

Route::get('test4', 'Admin\TestController@vi');
Route::get('test5', 'Admin\TestController@fore');
Route::get('test6', 'Admin\TestController@test6');
Route::post('test7', 'Admin\TestController@test7');

// DB的增删改查
Route::get('add', 'Admin\TestController@add');
Route::get('del', 'Admin\TestController@del');
Route::get('mod', 'Admin\TestController@mod');
Route::get('select', 'Admin\TestController@select');

// json响应
Route::get('json', 'TestController@json');