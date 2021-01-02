<?php

use Illuminate\Database\Seeder;
// 用户模型
use App\Models\User;

class UserSeeder extends Seeder {

    public function run() {
        // 清空数据表
        User::truncate();
        // 添加模拟数据
        factory(User::class, 100)->create();
        // 规定id=1的用户的用户名为admin
        User::where('id', 1)->update(['username' => 'admin']);
    }
}
