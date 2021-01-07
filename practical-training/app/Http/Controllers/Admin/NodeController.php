<?php

namespace App\Http\Controllers\Admin;

use App\Models\Node;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class NodeController extends Controller {

    // 权限列表
    public function index() {
        $data = (new Node())->getAllList();

        return view('admin.node.index', compact('data'));
    }

    // 添加页面
    public function create() {
        // 获取所有的根节点
        $data = Node::where('pid', 0)->get();
        return view('admin.node.create', compact('data'));
    }

    // 添加处理
    public function store(Request $request) {
        try {
            $this->validate($request, [
                'name' => 'required|unique:nodes,name'
            ]);
        } catch (ValidationException $e) {
            return ['error' => '验证不通过！'];
        }
        Node::create($request->except('_token'));
        return redirect(route('admin.node.index'))->with('success', '节点添加成功！');
    }


    public function show(Node $node) {
        //
    }

    // 修改页
    public function edit(Node $node) {
        $menu = Node::where('pid', 0)->get();
        $data = Node::find($node->id);
        return view('admin.node.edit', compact('data', 'menu'));
    }


    public function update(Request $request, Node $node) {
        try {
            $post = $this->validate($request, [
                'name' => 'required|unique:nodes,name,' . $node->id . ',id',
                'pid' => 'required',
                'is_menu' => 'required'
            ]);
        } catch (ValidationException $e) {
            return ['error' => '验证不通过！'];
        }
        $post['route_name'] = $request->get('route_name');
        Node::where('id', $node->id)->update($post);
        return redirect(route('admin.node.index'))->with('success', '节点修改成功！');
    }

    public function destroy(Node $node) {
        Node::find($node->id)->forceDelete();
        return ['status' => 200, 'msg' => '删除成功！'];
    }
}
