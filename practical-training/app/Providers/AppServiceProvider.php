<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

class AppServiceProvider extends ServiceProvider {

    public function register() {
        //
    }

    public function boot() {
        // 自定义验证规则
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            $reg1 = '/^\+86-1[3-9]\d{9}$/';
            $reg2 = '/^1[3-9]\d{9}$/';
            return preg_match($reg1, $value) || preg_match($reg2, $value);
        });
    }
}
