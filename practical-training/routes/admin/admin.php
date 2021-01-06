<?php
// 后台路由

// 路由分组
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 登录页面
    Route::get('login', 'LoginController@index')->name('admin.login');
    // 登录处理
    Route::post('login', 'LoginController@login')->name('admin.login');

    // 需要登录才能请求的接口
    Route::group(['middleware' => ['isLogin'], 'as' => 'admin.'], function () {
        // 退出登录
        Route::get('logout', 'LoginController@logout')->name('logout');

        // 后台首页
        Route::get('index', 'IndexController@index')->name('index');
        // 欢迎页面
        Route::get('welcome', 'IndexController@welcome')->name('welcome');

        // 用户列表
        Route::get('user/index', 'UserController@index')->name('user.index');
        // 添加用户页面
        Route::get('user/add', 'UserController@create')->name('user.create');
        // 添加用户处理
        Route::post('user/add', 'UserController@store')->name('user.store');
        // 删除用户
        Route::delete('user/delete/{id}', 'UserController@delete')->name('user.delete');
        // 还原用户
        Route::get('user/restore/{id}', 'UserController@restore')->name('user.restore');
        // 全选删除
        Route::delete('user/deleteAll', 'UserController@deleteAll')->name('user.deleteAll');
        // 修改用户页面
        Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
        // 修改用户处理
        Route::put('user/edit/{id}', 'UserController@update')->name('user.edit');

        // 权限管理，角色
        Route::resource('role', 'RoleController');
        // 权限管理，权限（节点）
        Route::resource('node','NodeController');
    });
});