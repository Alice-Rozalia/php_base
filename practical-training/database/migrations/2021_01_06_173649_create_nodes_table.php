<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration {

    // 权限表
    public function up() {
        Schema::create('nodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30)->comment('节点名称');
            $table->string('route_name', 70)->default('')->comment('路由别名');
            $table->unsignedInteger('pid')->default(0)->comment('上级id');
            $table->enum('is_menu', ['0', '1'])->default('0')->comment('是否为菜单，0否，1是');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down() {
        Schema::dropIfExists('nodes');
    }
}
