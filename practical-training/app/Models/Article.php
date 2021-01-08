<?php

namespace App\Models;

class Article extends Base {

    public function articleStatusCount() {
        // 未被删除的文章数量
        $useTotal = self::count();
        // 所有的文章数量
        $total = self::withTrashed()->count();
        return [
            'total' => $total,
            'useTotal' => $useTotal
        ];
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
