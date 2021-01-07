<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

    // 显示登录页
    public function index() {
        // 判断用户是否已经登录过
        if (auth()->check()) {
            return redirect(route('admin.index'));
        }
        return view('admin.login.login');
    }

    // 登录处理
    public function login(Request $request) {
        // 表单验证
        $post = $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $bool = auth()->attempt($post);
        if ($bool) {
            if (config('rbac.super') != $post['username']) {
                // 获取用户信息
                $userModel = auth()->user();
                // 获取用户角色
                $roleModel = $userModel->role;
                // 获取用户权限
                $nodeArr = $roleModel->nodes()->pluck('route_name', 'id')->toArray();
                session(['admin.auth' => $nodeArr]);
                return redirect(route('admin.index'));
            } elseif (auth()->user()->role_id == 1) {
                return redirect(route('home.index'));
            } else {
                session(['admin.auth' => true]);
                return redirect(route('admin.index'));
            }
        }

        return redirect(route('admin.login'))->withErrors(['error' => '用户名或密码错误！']);
    }

    // 退出登录
    public function logout() {
        // 清空session
        auth()->logout();
        return redirect(route('admin.login'))->with('success', '已注销登录！');
    }
}
