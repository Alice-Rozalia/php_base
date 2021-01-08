<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddArtRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends BaseController {

    // 文章列表页
    public function index(Request $request) {
        $key = $request->get('key', '');

        $data = Article::when($key, function ($query) use ($key) {
            $query->where('title', 'like', "%{$key}%");
        })->orderBy('id', 'asc')->withTrashed()->paginate($this->pageSize);

        return view('admin.article.index', compact('data', 'key'));
    }

    // 添加文章
    public function create() {
        return view('admin.article.create');
    }

    // 添加文章处理
    public function store(AddArtRequest $request) {
        $pic = config('up.pic');
        if ($request->hasFile('pic')) {
            // 上传
            $info = $request->file('pic')->store('', 'article');
            $pic = '/uploads/article/' . $info;
        }
        $post = $request->except('_token');
        $post['pic'] = $pic;
        $post['user_id'] = auth()->user()->id;
        Article::create($post);
        return redirect(route('admin.article.index'));
    }

    public function show(Article $article) {
        //
    }

    // 文章修改页面
    public function edit(Article $article) {
        return view('admin.article.edit', compact('article'));
    }

    public function update(Request $request, Article $article) {
        $putData = $request->except(['created_at', 'updated_at', 'deleted_at', '_token', 'id']);
        $article->update($putData);
        return redirect(route('admin.article.index'))->with('success', '文章修改成功！');
    }

    public function destroy(Article $article) {
        Article::find($article->id)->delete();
        return ['status' => 200, 'msg' => '删除成功！'];
    }

    public function restore(int $id) {
        Article::onlyTrashed()->where('id', $id)->restore();
        return redirect(route('admin.article.index'))->with('success', '文章还原成功！');
    }
}
