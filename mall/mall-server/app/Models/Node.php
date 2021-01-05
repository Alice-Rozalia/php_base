<?php

namespace App\Models;

class Node extends Base {

    // 修改器
    public function setPathAttribute($value) {
        $this->attributes['path'] = empty($value) ? '' : $value;
    }

    // 获取全部数据
    public function getAllList() {
        $data = self::get()->toArray();
        return $this->treeLevel($data);
    }

    // 获取带层级的数据
    public function treeData(array $allow_node) {
        $menuData = Node::where('is_menu', '1')->whereIn('id', $allow_node)->get()->toArray();
        return $this->subTree($menuData);
    }
}
