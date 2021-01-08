<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

    // 文章表
    public function up() {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 120)->comment('文章标题');
            $table->string('summary', 300)->default('')->comment('文章摘要');
            $table->string('pic', 150)->default('')->comment('文章封面');
            $table->text('content')->comment('文章内容');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('articles');
    }
}
