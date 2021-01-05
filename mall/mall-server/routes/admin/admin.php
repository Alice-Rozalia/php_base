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
        // 给用户分配角色
        Route::post('user/allot/{user}', 'UserController@allot');

        // 权限管理，分配权限
        Route::get('role/node/{role}', 'RoleController@node');
        // 权限管理，分配权限
        Route::post('role/node/{role}', 'RoleController@nodeSave');
        // 权限管理，角色路由
        Route::resource('role', 'RoleController');
        // 权限管理，权限路由
        Route::resource('node', 'NodeController');
    });
});