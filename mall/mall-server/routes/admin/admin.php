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
        // 添加用户
        Route::post('user/add', 'UserController@store');
        // 删除用户
        Route::delete('user/delete/{id}', 'UserController@del');
        // 还原用户
        Route::put('user/restore/{id}', 'UserController@restore');
        // 批量删除
        Route::delete('user/bulk_delete', 'UserController@bulkDelete');
        // 修改用户
        Route::put('user/edit/{id}', 'UserController@update');

        // 权限管理，资源路由
        Route::resource('role', 'RoleController');
    });
});