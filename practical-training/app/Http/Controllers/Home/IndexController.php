<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Article;
use Illuminate\Http\Request;

class IndexController extends BaseController {

    public function index(Request $request) {
        $key = $request->get('key', '');

        $data = Article::when($key, function ($query) use ($key) {
            $query->where('title', 'like', "%{$key}%");
        })->orderBy('id', 'asc')->paginate($this->pageSize);

        return view('home.index', compact('data', 'key'));
    }

    public function detail(Article $article) {
        return view('home.detail', compact('article'));
    }
}