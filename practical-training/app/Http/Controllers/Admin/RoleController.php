<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends BaseController {

    // 角色列表页
    public function index(Request $request) {
        // 获取搜索关键字
        $key = $request->get('key', '');
        $data = Role::when($key, function ($query) use ($key) {
            $query->where('name', 'like', "%{$key}%");
        })->paginate($this->pageSize);

        return view('admin.role.index', compact('data', 'key'));
    }

    // 角色添加页
    public function create() {
        return view('admin.role.create');
    }

    // 添加角色处理
    public function store(Request $request) {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name'
            ]);
        } catch (ValidationException $e) {
            return ['error' => '验证不通过！'];
        }

        Role::create($request->only('name'));
        return redirect(route('admin.role.index'))->with('success', '角色添加成功！');
    }

    // 显示单个角色信息
    public function show($id) {
        //
    }

    // 角色修改页
    public function edit(int $id) {
        $role = Role::find($id);
        return view('admin.role.edit', compact('role'));
    }

    // 角色修改处理
    public function update(Request $request, int $id) {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name,' . $id . ',id'
            ]);
        } catch (ValidationException $e) {
            return ['error' => '验证不通过！'];
        }
        Role::where('id', $id)->update($request->only(['name']));
        return redirect(route('admin.role.index'))->with('success', '角色修改成功！');
    }

    // 删除操作
    public function destroy(int $id) {
        Role::find($id)->delete();
        return ['status' => 200, 'msg' => '删除成功！'];
    }
}
