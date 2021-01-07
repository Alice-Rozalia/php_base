<?php

namespace App\Models;

class Node extends Base {
    // 修改器
    public function setRouteNameAttribute($value) {
        $this->attributes['route_name'] = empty($value) ? '' : $value;
    }

    // 访问器
    public function getMenuAttribute() {
        return $this->is_menu == 1 ? '<a href="javascript:;" class="layui-btn layui-btn-normal layui-btn-xs">是</a>' : '<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs">否</a>';
    }

    // 获取全部数据
    public function getAllList() {
        $data = self::get()->toArray();
        return $this->treeLevel($data);
    }

    // 获取带层级的数据
    public function treeData($allow_node) {
        $query = Node::where('is_menu', '1');
        if (is_array($allow_node)) {
            $query->whereIn('id', array_keys($allow_node));
        }
        $menuData = $query->get()->toArray();
        return $this->subTree($menuData);
    }
}
