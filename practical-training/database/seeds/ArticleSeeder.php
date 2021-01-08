<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder {

    public function run() {
        \App\Models\Article::truncate();
        factory(\App\Models\Article::class, 50)->create();
    }
}
