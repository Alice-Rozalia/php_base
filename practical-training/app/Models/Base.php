<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model {

    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    // 设置添加时的黑名单
    protected $guarded = [];

    /**
     * 数组合并，并加上html标识前缀
     * @param array $data
     * @param int $pid
     * @param string $html
     * @param int $level
     * @return array
     */
    public function treeLevel(array $data, int $pid = 0, string $html = '--', int $level = 0) {
        static $arr = [];
        foreach ($data as $val) {
            if ($pid == $val['pid']) {
                $val['html'] = str_repeat($html, $level * 2);
                $val['level'] = $level + 1;
                $arr[] = $val;
                $this->treeLevel($data, $val['id'], $html, $val['level']);
            }
        }
        return $arr;
    }

    // 树形菜单
    public function subTree(array $data, int $pid = 0) {
        $arr = [];
        foreach ($data as $val) {
            if ($pid == $val['pid']) {
                $val['sub'] = $this->subTree($data, $val['id']);
                $arr[] = $val;
            }
        }
        return $arr;
    }
}
