<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;

class TestController extends Controller {

    public function mod_add(Request $request) {
        // $model = new UserModel();
        // $model->name = '小明';
        // $model->email = 'xiaoming@qq.com';
        // $res = $model->save();

        // 增加数据的第二种方法
        $res = UserModel::create($request->all());
        dump($res);
    }

    public function mod_test1() {
        return view('admin.mod_test1');
    }

    public function file(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:2|max:20|unique:user',
            'email' => 'required|email',
            'code' => 'required|captcha'
        ]);

        // 判断文件上传是否正常和存在
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            // 重命名文件
            $name = sha1(time() . rand(100000, 999999)) . '.' . $request->file('avatar')->extension();
            // 文件的移动
            $request->file('avatar')->move('./upload', $name);
            $path = '/upload/' . $name;
        }

        // 通过验证规则后写入数据表
        $data = $request->except(['_token', 'avatar', 'code']);
        $data['avatar'] = isset($path) ? $path : '';
        $result = UserModel::insert($data);

        if ($result) {
            return redirect('model4');
        } else {
            return redirect('model2') -> withErrors(['用户添加失败！']);
        }
    }

    public function page() {
        // $data = UserModel::all();
        $data = UserModel::paginate(1);
        return view('admin.page', compact('data'));
    }

    public function json() {
        $data = UserModel::all();
        return response()->json($data);
    }
}
