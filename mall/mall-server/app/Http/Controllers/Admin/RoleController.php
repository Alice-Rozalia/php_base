<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends BaseController {

    public function index() {
        $data = Role::paginate($this->pageSize);
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
        //
    }

    /**
     * 删除操作
     * @param $id
     */
    public function destroy($id) {
        //
    }
}
