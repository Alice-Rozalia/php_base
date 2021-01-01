<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class TestController extends Controller {

    public function test1() {
        phpinfo();
    }

    // 接收用户输入
    public function test2() {
        // 1.get接收
        dump(Input::get('addr'));
        dump(Input::get('id'));

        // 2.all接收
        dump(Input::all());

        // 3.only接收
        dump(Input::only(['id', 'addr']));

        // 4.except接收
        dump(Input::except(['id']));

        // 5.has判断
        dump(Input::has('addr'));
    }

    public function add() {
        $data = [
            'name' => '鹰',
            'email' => '5354@qq.com'
        ];
        // 增加
        // dump(DB::table('user')->insert($data));
        dump(DB::table('user')->insertGetId($data));    // 返回新增记录的主键id
    }

    public function mod() {
        // 定义要修改的数组
        $data = ['name' => '鹰原'];
        dump(DB::table('user')->where('id', 2)->update($data));     // 返回受影响的行数
    }

    public function select() {
//        $data = DB::table('user')->get();   // 相当于select * from user
//        foreach ($data as $key => $value) {
//            echo $value->id . '--' . $value->name . '<br>';
//        }

        // 条件查询
        // $data = DB::table('user')->where('id', '<', 2)->get();  // select * from user where id < 2

        // $data = DB::table('user')->first();     // select * from user limit 1

        // 获取单个字段的值
        // $data = DB::table('user')->where('id', 1)->value('name');   // select name from user where id = 1

        // 获取多个字段
        // $data = DB::table('user')->select('name as username', 'email')->get();

        // 排序操作
        // $data = DB::table('user')->orderBy('id', 'desc')->get();

        // 分页操作
        $data = DB::table('user')->limit(1)->offset(0)->get();  // select * from user limit 0,1
        dump($data);
    }

    public function del() {
        $data = DB::table('user')->where('id', '>', 1)->delete();
        dump($data);    // 返回受影响的行数
    }

    public function vi() {
        $data = [
            'name' => '长生',
            'id' => 5,
            'age' => 88,
            'time' => time()
        ];
        return view('admin.test4', $data);
    }

    public function fore() {
        $data = DB::table('wish')->get();
        $day = date('N');
        return view('admin.fore', compact('data', 'day'));
    }

    public function test6() {
        return view('admin.test6');
    }

    public function test7() {
        return '转账成功，成功付款123';
    }
}
