<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Hash;

class UserController extends BaseController {

    /**
     * 用户列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userList(Request $request) {
        $where = function ($query) use ($request) {
            if ($request->has('key') and $request->key != '') {
                $search = "%" . $request->key . "%";
                $query->where('username', 'like', $search);
            }
        };
        // withTrashed --> 显示所以的用户，包括已经软删除的
        $data = User::where($where)->orderBy('id', 'asc')->withTrashed()->paginate($request->limit);
        $userList = [];
        foreach ($data as $item) {
            $item->toArray()['role'] = $item->role->name;
            array_push($userList, $item->toArray());
        }
        $res['total'] = $data->toArray()['total'];
        $res['users'] = $userList;
        return response()->json(Result::ok4($res));
    }

    /**
     * 添加用户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        try {
            $this->validate($request, [
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'phone' => 'nullable|phone'
            ]);
        } catch (ValidationException $e) {
            return response()->json(Result::error2('验证不通过！'));
        }

        $user = $request->all();
        $model = User::create($user);
        if ($model) {
            return response()->json(Result::ok2('用户添加成功！'));
        } else {
            return response()->json(Result::error2('用户添加失败！'));
        }
    }

    /**
     * 删除用户
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(int $id) {
        // 强制删除，在配置了软删除的时候，真实的删除
        // User::find($id)->forceDelete();

        $user = auth()->user();
        if ($user->id == $id) {
            return response()->json(Result::error2('无法删除当前用户！'));
        } else {
            // 软删除
            User::find($id)->delete();
            return response()->json(Result::ok2('用户删除成功！'));
        }
    }

    /**
     * 还原用户
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(int $id) {
        User::onlyTrashed()->where('id', $id)->restore();
        return response()->json(Result::ok2('用户还原成功！'));
    }

    /**
     * 批量删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkDelete(Request $request) {
        $ids = $request->get('ids');
        User::destroy($ids);
        return response()->json(Result::ok2('批量删除成功！'));
    }

    /**
     * 修改用户
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
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
            return response()->json(Result::ok2('用户修改成功！'));
        } else {
            return response()->json(Result::error2('原密码错误！'));
        }
    }

    // 分配角色
    public function allot(Request $request, User $user) {
        $post = $this->validate($request, [
            'role_id' => 'required'
        ], [
            'role_id.required' => '角色id不能为空！'
        ]);

        $user->update($post);
        return response()->json(Result::ok2('角色修改成功！'));
    }
}
