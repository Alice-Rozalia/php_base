<?php

namespace App\Models\Traits;


trait Btn {

    // 编辑按钮
    public function editBtn(string $route) {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        }
        return '<a href="' . route($route, $this) . '" class="layui-btn layui-btn-xs" style="background-color: #409eff">编辑</a>';
    }

    // 删除按钮
    public function deleteBtn(string $route) {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        }
        return '<a href="' . route($route, $this) . '" class="layui-btn layui-btn-xs deleteBtn" style="background-color: #f56c6c">删除</a>';
    }

    public function restoreBtn(string $route) {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        }
        return '<a href="' . route($route, $this) . '" class="layui-btn layui-btn-xs" style="background-color: #ebb563">还原</a>';
    }

    public function allotBtn(string $route) {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        }
        return '<a href="' . route($route, $this) . '" class="layui-btn layui-btn-xs" style="background-color: #00b5ad">分配权限</a>';
    }

    // 编辑按钮
    public function editBtn2(string $route) {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        }
        return '<a href="' . route($route, $this) . '" class="mini ui blue button">编辑</a>';
    }

    // 删除按钮
    public function deleteBtn2(string $route) {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        }
        return '<a href="' . route($route, $this) . '" class="mini ui red button deleteBtn">删除</a>';
    }

    public function restoreBtn2(string $route) {
        if (auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)) {
            return '';
        }
        return '<a href="' . route($route, $this) . '" class="mini ui yellow button">还原</a>';
    }
}