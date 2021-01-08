<?php

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'summary' => $faker->paragraph(3, true),
        'pic' => '/uploads/article/' . rand(1, 6) . '.jpg',
        'content' => $faker->realText()
    ];
});
