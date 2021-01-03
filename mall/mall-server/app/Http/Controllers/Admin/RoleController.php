<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends BaseController {

    public function index(Request $request) {
        $where = function ($query) use ($request) {
            if ($request->has('key') and $request->key != '') {
                $search = "%" . $request->key . "%";
                $query->where('name', 'like', $search);
            }
        };
        $data = Role::where($where)->orderBy('id', 'asc')->withTrashed()->paginate($request->limit);
        return response()->json(Result::ok4($data));
    }

    public function create() {
        //
    }

    // 添加处理
    public function store(Request $request) {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name'
            ]);
        } catch (ValidationException $e) {
            return response()->json(Result::error2("验证不通过！"));
        }
        Role::create($request->only('name'));
        return response()->json(Result::ok4("添加成功！"));
    }

    /**
     * 根据id查询
     * @param $id
     */
    public function show($id) {
        //
    }

    /**
     * 修改显示
     * @param $id
     */
    public function edit($id) {
        //
    }

    /**
     * 修改处理
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id) {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name,' . $id . ',id'
            ]);
        } catch (ValidationException $e) {
            return response()->json(Result::error2("验证不通过！"));
        }

        Role::where('id', $id)->update($request->only(['name']));
        return response()->json(Result::ok2('角色修改成功！'));
    }

    /**
     * 删除操作
     * @param $id
     */
    public function destroy($id) {
        //
    }
}
