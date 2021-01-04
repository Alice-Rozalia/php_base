<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\Node;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class NodeController extends Controller {
    /**
     * 获取权限列表
     */
    public function index() {
        $data = (new Node)->getAllList();
        return response()->json(Result::ok4($data));
    }

    /**
     * 添加视图
     */
    public function create() {
        // 获取所有的根节点权限
        $data = Node::where('pid', 0)->get();
        return response()->json(Result::ok4($data));
    }

    /**
     * 添加处理
     * @param Request $request
     */
    public function store(Request $request) {
        try {
            $this->validate($request, [
                'name' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(Result::error2("验证不通过！"));
        }
        Node::create($request->all());
        return response()->json(Result::ok4("添加成功！"));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Node $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Node $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Node $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Node $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node) {
        //
    }
}
