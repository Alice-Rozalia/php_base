<?php
// 后台路由

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 登录处理
    Route::post('login', 'LoginController@login');

    // 需要登录才能请求的接口
    Route::group(['middleware' => ['islogin']], function () {
        // 退出登录
        Route::get('logout', 'LoginController@logout');

        // 用户列表
        Route::get('user/list', 'UserController@userList');

        // 权限管理，资源路由
        Route::resource('role', 'RoleController');
    });
});