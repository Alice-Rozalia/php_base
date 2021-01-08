<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Node;
use App\Models\User;

class IndexController extends Controller {
    // 显示后台首页
    public function index() {
        $auth = session('admin.auth');
        // 获取菜单
        $menu = (new Node())->treeData($auth);
        return view('admin.index.index', compact('menu'));
    }

    // 后台欢迎页面
    public function welcome() {
        $article = (new Article())->articleStatusCount();
        $user = (new User())->userStatusCount();
        return view('admin.index.welcome', compact('article', 'user'));
    }
}
