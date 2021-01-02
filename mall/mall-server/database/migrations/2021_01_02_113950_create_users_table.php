<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    /**
     * 后台用户表
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 50)->comment('用户名');
            $table->string('password', 300)->comment('密码');
            $table->string('email', 50)->default('')->comment('邮箱');
            $table->string('phone', 30)->default('')->comment('手机号码');
            $table->enum('gender', ['男', '女'])->default('男')->comment('性别');
            $table->string('avatar')->default('')->comment('头像');
            $table->char('last_ip', 15)->default('')->comment('登录ip');
            $table->unsignedInteger('role_id')->default(0)->comment('角色id');
            $table->timestamps();
            // 软删除，生成字段 delete_at 字段
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}
