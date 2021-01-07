<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends BaseController {

    // 用户列表页
    public function index(Request $request) {
        // 获取搜索关键字
        $key = $request->get('key', '');
        // 获取用户列表
        $data = User::when($key, function ($query) use ($key) {
            $query->where('username', 'like', "%{$key}%");
        })->orderBy('id', 'asc')->withTrashed()->paginate($this->pageSize);

        return view('admin.user.index', compact('data', 'key'));
    }

    // 用户添加页
    public function create() {
        return view('admin.user.create');
    }

    // 添加用户
    public function store(Request $request) {
        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'phone' => 'nullable|phone'
        ]);

        $post = $request->except(['_token', 'password_confirmation']);
        $post['password'] = bcrypt($post['password']);
        $post['role_id'] = 1;
        $post['avatar'] = 'https://xd-video-pc-img.oss-cn-beijing.aliyuncs.com/xdclass_pro/default/head_img/11.jpeg';
        User::create($post);

        return redirect(route('admin.user.index'))->with('success', '用户添加成功！');
    }

    // 删除用户
    public function delete(int $id) {
        User::find($id)->delete();
        return ['status' => 200, 'msg' => '删除成功！'];
    }

    // 还原用户
    public function restore(int $id) {
        User::onlyTrashed()->where('id', $id)->restore();
        return redirect(route('admin.user.index'))->with('success', '用户还原成功！');
    }

    // 批量删除
    public function deleteAll(Request $request) {
        $ids = $request->get('id');
        User::destroy($ids);
        return ['status' => 200, 'msg' => '批量删除成功！'];
    }

    // 用户修改页
    public function edit(int $id) {
        $model = User::find($id);

        return view('admin.user.edit', compact('model'));
    }

    // 修改用户
    public function update(Request $request, int $id) {
        $user = User::find($id);

        // 用户输入的原密码
        $originalPassword = $request->get('originalPassword');
        // 真正的原密码（密文）
        $pass = $user->password;

        $bool = Hash::check($originalPassword, $pass);

        if ($bool) {
            $data = $request->only([
                'username',
                'password',
                'phone',
                'email',
                'gender'
            ]);
            if (!empty($data['password'])) {
                // 密码加密
                $data['password'] = bcrypt($data['password']);
            } else {
                // 如果用户不修改密码
                unset($data['password']);
            }
            // 修改
            $user->update($data);
            return redirect(route('admin.user.index'))->with('success', '用户修改成功！');
        } else {
            return redirect(route('admin.user.edit', $user))->withErrors(['error' => '原密码不正确！']);
        }
    }

    // 分配角色页面
    public function role(User $user) {
        // 获取所有的角色
        $allRole = Role::all();
        return view('admin.user.role', compact('user', 'allRole'));
    }

    // 分配角色处理
    public function allot(Request $request, User $user) {
        $post = $this->validate($request, [
            'role_id' => 'required'
        ], ['role_id.required' => '必须选择角色！']);

        $user->update($post);
        return redirect(route('admin.user.index'))->with(['success' => '角色分配成功，重新登录后生效！']);
    }
}
