<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

// 生成模拟数据的工厂格式
$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->name(),
        'password' => bcrypt('123456'),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'avatar' => 'https://xd-video-pc-img.oss-cn-beijing.aliyuncs.com/xdclass_pro/default/head_img/11.jpeg',
        'gender' => ['男', '女'][rand(0, 1)]
    ];
});
