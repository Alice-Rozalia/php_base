<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Btn;

class User extends AuthUser {
    // 调用定义的trait类
    use SoftDeletes, Btn;

    // 软删除标识字段
    protected $dates = ['deleted_at'];

    // 设置不添加的字段
    protected $guarded = [];
    // 隐藏字段
    protected $hidden = ['password'];

    // 关联角色
    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function userStatusCount() {
        // 未被删除的用户数量
        $canUseUserTotal = self::count();
        // 所有的用户数量
        $userTotal = self::withTrashed()->count();
        return [
            'total' => $userTotal,
            'useTotal' => $canUseUserTotal
        ];
    }
}
