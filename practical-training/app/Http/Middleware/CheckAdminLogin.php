<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogin {

    public function handle($request, Closure $next) {
        if (!auth()->check()) {
            return redirect(route('admin.login'))->withErrors(['error' => '尚未登录！']);
        }

        // 获取用户能访问的路由
        $auths = is_array(session('admin.auth')) ? array_filter(session('admin.auth')) : [];

        $not_allow = [
            'admin.index',
            'admin.welcome',
            'admin.user.index',
            'admin.role.index',
            'admin.node.index'
        ];

        $not_go = array_merge($auths, $not_allow);

        $auths = array_merge($auths, config('rbac.allow_route'));
        // 用户当前访问的路由
        $currentRoute = $request->route()->getName();

        if (auth()->user()->role_id == 1 && in_array($currentRoute, $not_go)) {
            return redirect('/');
        }

        if (auth()->user()->username != config('rbac.super') && !in_array($currentRoute, $auths)) {
            exit('权限不足！');
        }

        // 通过request传递权限列表
        $request->auths = $auths;

        return $next($request);
    }
}
