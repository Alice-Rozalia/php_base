<?php

namespace App\Http\Controllers\Admin;

use App\Models\Node;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller {

    public function login(Request $request) {
        $form = null;
        try {
            $form = $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(Result::error2('验证不通过！'));
        }

        // 登录
        if (auth()->attempt($form)) {
            // 返回当前登录的用户信息，存储在session中
            $user = auth()->user();
            // 获取用户的角色
            $role = $user->role;
            // 根据角色获取菜单
            $node = $role->nodes()->pluck('name', 'id')->toArray();
            $menu = (new Node())->treeData(array_keys($node));
            return response()->json(Result::ok3("登录成功！", compact('user', 'menu')));
        } else {
            return response()->json(Result::error2("用户名或密码错误！"));
        }
    }

    public function logout() {
        auth()->logout();
        return response()->json(Result::ok2("注销登录成功！"));
    }
}
